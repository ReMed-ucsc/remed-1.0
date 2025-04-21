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

    public function getAllDeliveriesOfADriver($driverId)
    {
        $data = ["DriverID" => $driverId];

        return $this->where($data);
    }

    public function addDelivery($data)
    {
        return $this->insert($data);
    }

    public function getAllDeliveryForOrder($orderId)
    {
        $columns = ['DeliveryID'];
        $data = [
            'orderId' => $orderId
        ];

        $delivery = $this->selectWhere(
            $columns,
            $data
        );

        //show($delivery);

        return $delivery;
    }

    public function changeDeliveryStatus($deliveryId, $status)
    {
        date_default_timezone_set("Asia/Colombo"); //for setting time zone

        if ($status == "Delivered") {
            $data = [
                'status' => $status,
                'deliveredTime' => date('H:i:s')
            ];
        } else {
            $data = [
                'status' => $status
            ];
        }

        $this->update($deliveryId, $data, 'DeliveryID');
    }
}
