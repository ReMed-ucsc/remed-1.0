<?php

class Patient
{
    use Model;

    protected $table = 'patients';
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

    public function searchPharmaciesWithMedicines($latitude, $longitude, $productIDs, $range = 10)
    {
        $rangeInMeters = $range * 1000;
        $placeholders = implode(',', array_fill(0, count($productIDs), '?'));

        $joinCondition = "InventoryView.PharmacyID = pharmacies.id";
        $columns = "pharmacies.id AS PharmacyID, pharmacies.name, pharmacies.latitude, pharmacies.longitude,
                    ST_Distance_Sphere(POINT(pharmacies.longitude, pharmacies.latitude), POINT(:longitude, :latitude)) AS distance";
        $data = [
            'longitude' => $longitude,
            'latitude' => $latitude,
            'rangeInMeters' => $rangeInMeters
        ];
        $data_not = [];
        $additionalConditions = "ST_Distance_Sphere(POINT(pharmacies.longitude, pharmacies.latitude), POINT(:longitude, :latitude)) <= :rangeInMeters
                                 AND InventoryView.ProductID IN ($placeholders)";

        $result = $this->join('pharmacies', $joinCondition, $data, $data_not, $columns, 'distance', 'ASC', 10, 0, $additionalConditions, $productIDs);

        return $result;
    }

    public function searchNearbyPharmacy($latitude, $longitude, $range = 10)
    {
        $rangeInMeters = $range * 1000;

        $columns = "pharmacies.id AS PharmacyID, pharmacies.name, pharmacies.contactNo, pharmacies.address, pharmacies.latitude, pharmacies.longitude,
                    ST_Distance_Sphere(POINT(pharmacies.longitude, pharmacies.latitude), POINT(:longitude, :latitude)) AS distance";
        $data = [
            'longitude' => $longitude,
            'latitude' => $latitude,
            'rangeInMeters' => $rangeInMeters
        ];
        $data_not = [];
        $additionalConditions = "ST_Distance_Sphere(POINT(pharmacies.longitude, pharmacies.latitude), POINT(:longitude, :latitude)) <= :rangeInMeters";

        $result = $this->join('pharmacies', '1=1', $data, $data_not, $columns, 'distance', 'ASC', 10, 0, $additionalConditions);

        return $result;
    }
}
