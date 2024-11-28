<?php

class DeliveryView
{
    use Model;

    protected $table = 'orderview';
    protected $allowed = ['DeliveryID', 'OrderID', 'DriverID', 'PharmacyID', 'PatientID'];

    public function getDeliveryInfo($orderId)
    {
        $columns = ['orderview.destination', 'pharmacy.address', 'pharmacy.name', 'orderview.status'];
        $data = ['OrderID' => $orderId];

        $this->setLimit(1);

        $deliveryData = $this->join(
            'pharmacy',
            'orderview.PharmacyID = pharmacy.PharmacyID',
            $data,
            [],
            $columns
        );

        $columns = ['patient.patientName', 'patient.contact'];
        $data = ['OrderID' => $orderId];

        $userdata = $this->join(
            'patient',
            'orderview.PatientID = patient.PatientID',
            $data,
            [],
            $columns
        );

        $data = [
            "orderId" => $orderId,
            "pharmacyName" => $deliveryData[0]->name,
            "parmacyAddrress" => $deliveryData[0]->address,
            "destination" => $deliveryData[0]->destination,
            "patientName" => $userdata[0]->patientName,
            "contactNo" => $userdata[0]->contact,
            "status" => $deliveryData[0]->status
        ];

        return $data;
    }
}

