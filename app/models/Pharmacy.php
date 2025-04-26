<?php
class Pharmacy extends User
{
    use Model;

    protected $table = 'pharmacy';

    protected $allowedColumns = [
        'PharmacyID',
        'RegNo',
        'contactNo',
        'address',
        'name',
        'pharmacistName',
        'approvedDate',
        'email',
        'password',
        'token',
        'name',
        'status',
        'document',
        'latitude',
        'longitude'
    ];
    protected $order_column = "PharmacyID";

    public function delete($id, $id_column = 'PharmacyID')
    {
        try {
            // Validate ID
            if (empty($id)) {
                throw new Exception("Invalid pharmacy ID");
            }

            $data[$id_column] = $id;
            $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";

            // Execute the query and check result
            $result = $this->query($query, $data);

            if ($result === false) {
                throw new Exception("Failed to execute delete query");
            }

            return true;
        } catch (Exception $e) {
            error_log("Error deleting pharmacy: " . $e->getMessage());
            return false;
        }
    }
    public function getPharmacyById($id)
    {
        $data = ['PharmacyID' => $id];
        return $this->first($data);
    }

    function validate($data)
    {
        $this->errors = []; // Reset errors

        // Validate pharmacy name
        if (empty($data['name'])) {
            $this->errors['name'] = "Pharmacy name is required.";
        }

        // Validate email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format.";
        }

        // Validate contact number
        if (!is_numeric($data['contactNo']) || strlen($data['contactNo']) < 10) {
            $this->errors['contactNo'] = "Invalid contact number.";
        }

        return empty($this->errors); // Pass if no errors
    }


    public function registerPharmacy($pharmacyName, $pharmacistName, $license, $contactNo, $email, $address, $document, $latitude, $longitude)
    {
        if ($this->getPharmacyByEmail($email)) {
            return false;
        } else {
            $data = [
                'name' => $pharmacyName,
                'pharmacistName' => $pharmacistName,
                'email' => $email,
                'address' => $address,
                'contactNo' => $contactNo,
                'license' => $license,
                'document' => $document,
                'status' => 'APPROVED',
                'latitude' => $latitude,
                'longitude' => $longitude
            ];
            return $this->insert($data);
        }
    }

    public function getPharmacyByEmail($email)
    {
        $data = ['email' => $email];
        return $this->first($data);
    }

    public function getPharmacies($status = "APPROVED")
    {
        $sql = "Select * FROM $this->table where status = :status";
        return $this->query($sql, ['status' => $status]);
    }
    public function getlastId($status="APPROVED")
    {
        $sql = "SELECT COUNT(*) AS approved_count FROM $this->table WHERE status = :status";
        $result = $this->query($sql, ['status' => $status]);

        if (is_array($result) && isset($result[0])) {
            return $result[0]->approved_count; // Access the property as an object
        }
        return 0;
    }
    public function notification($status="pending"){
        $sql="SELECT name , PharmacyID FROM $this->table WHERE status = :status LIMIT 5";
        return $this->query($sql,['status'=> $status]);
    }

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

    public function rejectPharmacy($id){
        $sql="UPDATE $this->table SET status = 'REJECT' WHERE PharmacyID = :id";
        return $this->query($sql,['id'=>$id]);
    }

    
}
