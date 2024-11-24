<?php

class Delivery
{
    use Model;

    protected $table = 'delivery';
    protected $allowed = ['DeliveryID', 'OrderID', 'DriverID', 'PharmacyID', 'PatientID'];

    public function getDeliveryInfo($deliverId)
    {
        $data = ["DeliveryID" => $deliverId];

        return $this->first($data);
    }
}
