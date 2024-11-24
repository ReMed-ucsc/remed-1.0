<?php

class DeliveryView
{
    use Model;

    protected $table = 'orderview';
    protected $allowed = ['DeliveryID', 'OrderID', 'DriverID', 'PharmacyID', 'PatientID'];

    public function getDeliveryInfo($orderId)
    {
        $data = ["orderID" => $orderId];

        return $this->first($data);
    }
}
