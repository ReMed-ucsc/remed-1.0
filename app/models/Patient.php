<?php

class Patient extends User
{
    use Model;
    // use User;

    protected $table = 'patient';
    protected $allowedColumns = ['name', 'email', 'password', 'token'];

    public function getOrderHistory($patientID)
    {
        $query = "SELECT * FROM medicineOrder WHERE PatientID = :patientID";
        $data = ['patientID' => $patientID];
        return $this->query($query, $data);
    }

    public function getOrderMedicines($orderID, $patientID)
    {
        $query = "SELECT * FROM OrderView WHERE OrderID = :orderID AND PatientID = :patientID";
        $data = ['orderID' => $orderID, 'patientID' => $patientID];
        return $this->query($query, $data);
    }

    public function searchPharmaciesWithMedicines($latitude, $longitude, $productIDs, $range = 10)
    {
        $orderModel = new OrderView();
        return $orderModel->searchPharmaciesWithMedicines($latitude, $longitude, $productIDs, $range);
    }

    public function searchNearbyPharmacy($latitude, $longitude, $range = 10)
    {
        $orderModel = new OrderView();
        return $orderModel->searchNearbyPharmacy($latitude, $longitude, $range);
    }
}
