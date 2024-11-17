<?php

class InventoryView
{
    use Model;

    protected $table = 'InventoryView';
    protected $allowedColumns = ['PharmacyID', 'ProductID', 'ProducName', 'availableCount', 'latitude', 'longitude'];
    protected $order_column = "id";

    public function searchPharmaciesWithMedicines($latitude, $longitude, $productIDs, $range = 10)
    {
        $rangeInMeters = $range * 1000;
        // Define columns to select
        $columns = [
            'PharmacyID',
            'name',
            'latitude',
            'longitude',
            'ST_Distance_Sphere(POINT(longitude, latitude), POINT(:longitude, :latitude)) AS distance',
            'availableCount'
        ];

        // Use raw SQL for distance calculation
        $conditions = [
            'raw' => "ST_Distance_Sphere(POINT(longitude, latitude), POINT(:longitude, :latitude)) <= :rangeInMeters",
            'ProductID' => [
                'in' => $productIDs
            ]
        ];

        // Additional data for binding
        $additionalData = [
            'longitude' => $longitude,
            'latitude' => $latitude,
            'rangeInMeters' => $rangeInMeters
        ];

        // Call the selectWhere method
        return $this->selectWhere($columns, $conditions, $additionalData, 'distance ASC', 'PharmacyID');
    }
}
