<?php

class Pharmacy extends User
{
    use Model;

    protected $table = 'pharmacy';
    protected $allowedColumns = ['PharmacyID', 'RegNo', 'name', 'contactNo', 'address', 'latitude', 'longitude'];
    protected $order_column = "PharmacyID";

    public function searchNearbyPharmacy($latitude, $longitude, $range = 10)
    {
        $rangeInMeters = $range * 1000;

        // Define columns to select
        $columns = [
            'PharmacyID',
            'name',
            'contactNo',
            'address',
            'latitude',
            'longitude',
            'ST_Distance_Sphere(POINT(longitude, latitude), POINT(:longitude, :latitude)) AS distance'
        ];

        // Define conditions
        $conditions = [
            'raw' => "ST_Distance_Sphere(POINT(longitude, latitude), POINT(:longitude, :latitude)) <= :rangeInMeters"
        ];

        // Bind additional parameters for raw SQL conditions
        $additionalData = [
            'longitude' => $longitude,
            'latitude' => $latitude,
            'rangeInMeters' => $rangeInMeters
        ];

        return $this->selectWhere($columns, $conditions, $additionalData, 'distance ASC');
    }
}
