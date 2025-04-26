<?php

class DeliveryView
{
    use Model;

    protected $table = 'OrderView';
    protected $allowed = ['DeliveryID', 'OrderID', 'DriverID', 'PharmacyID', 'PatientID', 'destination', 'status', 'created_at', 'updated_at'];

    public function getDeliveryInfo($orderId, $driverId)
    {
        $columns = [
            'OrderView.Destination',
            'pharmacy.PharmacyID',
            'pharmacy.address',
            'pharmacy.name',
            'OrderView.status',
            'pharmacy.latitude',
            'pharmacy.longitude'
        ];

        $data = ['OrderID' => $orderId];

        $this->setLimit(1);

        $deliveryData = $this->join(
            'pharmacy',
            'OrderView.PharmacyID = pharmacy.PharmacyID',
            $data,
            [],
            $columns
        );

        //print_r($deliveryData);
        $data = ['OrderID' => $orderId];

        $query = "SELECT destinationLat, destinationLong FROM medicineOrder WHERE OrderID = :OrderID";
        $orderData = $this->query(
            $query,
            $data
        );

        //print_r($orderData);

        $columns = ['patient.patientName', 'patient.contact'];
        $data = ['OrderID' => $orderId];

        $userdata = $this->join(
            'patient',
            'OrderView.PatientID = patient.PatientID',
            $data,
            [],
            $columns
        );

        //Insert data into delivery table
        $deldata = [
            'orderId' => $orderId,
            'driverId' => $driverId,
            'address' => $deliveryData[0]->address,
            'longitude' => $deliveryData[0]->longitude,
            'latitude' => $deliveryData[0]->latitude,
            'date' => date('Y-m-d'),
            'status' => 'On Delivery',
            'contact' => $userdata[0]->contact
        ];

        $deliveryModel = new Delivery();
        $deliveryModel->addDelivery($deldata);

        //getting delivery Id
        $deliveryIds = [];
        $deliveryIds = (array) $deliveryModel->getAllDeliveryForOrder($orderId);

        //show($deliveryIds);

        $lastDelivryId = ($deliveryIds[0]);

        //show($lastDelivryId);

        $data = [
            "orderId" => $orderId,
            "deliveryId" => $lastDelivryId->DeliveryID,
            "pharmacyName" => $deliveryData[0]->name,
            "pharmacyId" => $deliveryData[0]->PharmacyID,
            "pharmacyAddrress" => $deliveryData[0]->address,
            "destination" => $deliveryData[0]->destination,
            "patientName" => $userdata[0]->patientName,
            "contactNo" => $userdata[0]->contact,
            "status" => $deliveryData[0]->status,
            "pharmacyLatitude" => $deliveryData[0]->latitude,
            "pharmacyLongitude" => $deliveryData[0]->longitude,
            "destinationLatitude" => $orderData[0]->destinationLat,
            "destinationLongitude" => $orderData[0]->destinationLong,
        ];

        return $data;
    }

    public function getDeliveryInfoForOnTheRoad($orderId, $driverId)
    {
        $columns = [
            'OrderView.Destination',
            'pharmacy.PharmacyID',
            'pharmacy.address',
            'pharmacy.name',
            'OrderView.status',
            'pharmacy.latitude',
            'pharmacy.longitude'
        ];

        $data = ['OrderID' => $orderId];

        $this->setLimit(1);

        $deliveryData = $this->join(
            'pharmacy',
            'OrderView.PharmacyID = pharmacy.PharmacyID',
            $data,
            [],
            $columns
        );

        //print_r($deliveryData);
        $data = ['OrderID' => $orderId];

        $query = "SELECT destinationLat, destinationLong FROM medicineOrder WHERE OrderID = :OrderID";
        $orderData = $this->query(
            $query,
            $data
        );

        //print_r($orderData);

        $columns = ['patient.patientName', 'patient.contact'];
        $data = ['OrderID' => $orderId];

        $userdata = $this->join(
            'patient',
            'OrderView.PatientID = patient.PatientID',
            $data,
            [],
            $columns
        );

        //Insert data into delivery table
        $deldata = [
            'orderId' => $orderId,
            'driverId' => $driverId,
            'address' => $deliveryData[0]->address,
            'longitude' => $deliveryData[0]->longitude,
            'latitude' => $deliveryData[0]->latitude,
            'date' => date('Y-m-d'),
            'status' => 'On Delivery',
            'contact' => $userdata[0]->contact
        ];

        $deliveryModel = new Delivery();
        $deliveryModel->addDelivery($deldata);

        //getting delivery Id
        $deliveryIds = [];
        $deliveryIds = (array) $deliveryModel->getAllDeliveryForOrder($orderId);

        //show($deliveryIds);

        $lastDelivryId = ($deliveryIds[0]);

        //show($lastDelivryId);

        $data = [
            "orderId" => $orderId,
            "deliveryId" => $lastDelivryId->DeliveryID,
            "pharmacyName" => $deliveryData[0]->name,
            "pharmacyId" => $deliveryData[0]->PharmacyID,
            "pharmacyAddrress" => $deliveryData[0]->address,
            "destination" => $deliveryData[0]->destination,
            "patientName" => $userdata[0]->patientName,
            "contactNo" => $userdata[0]->contact,
            "status" => $deliveryData[0]->status,
            "pharmacyLatitude" => $deliveryData[0]->latitude,
            "pharmacyLongitude" => $deliveryData[0]->longitude,
            "destinationLatitude" => $orderData[0]->destinationLat,
            "destinationLongitude" => $orderData[0]->destinationLong,
        ];

        return $data;
    }
}
