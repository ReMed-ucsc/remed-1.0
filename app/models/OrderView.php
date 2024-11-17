<?php

class OrderView
{
    use Model;

    protected $table = 'OrderView';
    protected $allowedColumns = ['OrderID', 'PatientID', 'MedicineID', 'Quantity', 'PharmacyID'];

    public function getOrderDetails($orderID)
    {
        return $this->first(['OrderID' => $orderID]);
    }

    public function searchPharmaciesWithMedicines($latitude, $longitude, $productIDs, $range = 10)
    {
        $rangeInMeters = $range * 1000;
        $placeholders = implode(',', array_map(fn($key) => ":productID$key", array_keys($productIDs)));

        $query = "
        SELECT PharmacyID, name, latitude, longitude,
        ST_Distance_Sphere(POINT(longitude, latitude), POINT(:longitude, :latitude)) AS distance, availableCount
        FROM InventoryView
        WHERE ST_Distance_Sphere(POINT(longitude, latitude), POINT(:longitude, :latitude)) <= :rangeInMeters
        AND ProductID IN ($placeholders)
        GROUP BY PharmacyID
        ORDER BY distance ASC";

        $data = [
            'longitude' => $longitude,
            'latitude' => $latitude,
            'rangeInMeters' => $rangeInMeters
        ];

        foreach ($productIDs as $key => $productID) {
            $data["productID$key"] = $productID;
        }

        return $this->query($query, $data);
    }

    public function searchNearbyPharmacy($latitude, $longitude, $range = 10)
    {
        $rangeInMeters = $range * 1000;

        $query = "
        SELECT PharmacyID, name, contactNo, address, latitude, longitude,
        ST_Distance_Sphere(POINT(longitude, latitude), POINT(:longitude, :latitude)) AS distance
        FROM pharmacy
        WHERE ST_Distance_Sphere(POINT(longitude, latitude), POINT(:longitude, :latitude)) <= :rangeInMeters
        ORDER BY distance ASC";

        $data = [
            'longitude' => $longitude,
            'latitude' => $latitude,
            'rangeInMeters' => $rangeInMeters
        ];

        return $this->query($query, $data);
    }
}
