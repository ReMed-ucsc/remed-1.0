<?php

class Patient extends User
{
    // use Model;

    protected $table = 'patient';
    protected $allowedColumns = ['name', 'email', 'password', 'token'];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email address";
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required";
        }

        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    public function getPatientByEmail($email)
    {
        $data = ['email' => $email];
        return $this->first($data);
    }

    public function updateToken($email, $token)
    {
        $data = ['token' => $token];
        $this->update($email, $data, 'email');
    }

    public function registerPatient($name, $email, $password)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
        return $this->insert($data);
    }

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
