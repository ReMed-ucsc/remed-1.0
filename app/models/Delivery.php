<?php

class Delivery
{
    use Model;

    protected $table = 'delivery';
    protected $allowed = ['DeliveryID', 'OrderID', 'DriverID', 'PharmacyID', 'PatientID', 'totalDistance'];

    public function getDeliveryInfo($deliverId)
    {
        $data = ["DeliveryID" => $deliverId];

        return $this->first($data);
    }

    public function getAllDeliveriesOfADriver($driverId)
    {
        $data = ["DriverId" => $driverId];

        return $this->selectWhere(['*'], $data, [], 'DeliveryID DESC');
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
            $data,
            [],
            'DeliveryID DESC'
        );

        //show($delivery);

        return $delivery;
    }

    public function setDistance($deliverId, $distance)
    {
        $data = [
            "totalDistance" => $distance
        ];

        return $this->update($deliverId, $data, 'DeliveryID');
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

    public function getMonthlyDeliveries($driverId, $month)
    {
        $query = "SELECT driverId, totalDeliveries FROM driverDeliveries WHERE driverId = :driverId AND month = :month";
        $data = [
            'driverId' => $driverId,
            'month' => $month
        ];

        return $this->query($query, $data);
    }

    public function addToBreakDownAfterPickup($driverId, $deliveryId, $orderId, $latitude, $longitude)
    {
        $query = "INSERT INTO breakdownDelivery (driverId, deliveryId, orderId, latitude, longitude) VALUES
         (:driverId, :deliveryId, :orderId, :latitude, :longitude)";

        $data = [
            'driverId' => $driverId,
            'deliveryId' => $deliveryId,
            'orderId' => $orderId,
            'latitude' => $latitude,
            'longitude' => $longitude
        ];

        return $this->query($query, $data);
    }
}
