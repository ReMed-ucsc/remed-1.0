<?php

class Driver extends User
{
    use Model;

    protected $table = 'driver';
    protected $allowedColumns = [
        'driverId',
        'driverName',
        'email',
        'password',
        'token',
        'dob',
        'address',
        'fcmToken',
        'telNo',
        'NIC',
        'deliveryTime',
        'vehicalLicenseNo',
        'document',
        'status'
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['driverName'])) {
            $this->errors['driverName'] = 'name is required';
        } 
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $$this->errors['email'] = 'Invalid email address';
        }

        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    public function getDriverByEmail($email)
    {
        $query = "SELECT * FROM driver WHERE email = :email LIMIT 1";
        $result = $this->query($query, ['email' => $email]);

        return $result ? $result[0] : null; // Return the first object or null
    }

    public function registerDriver($name, $email, $password, $dob, $tellNo, $NIC, $deliveryTime)
    {
        $data = [
            'driverName' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'dob' => $dob,
            'telNo' => $tellNo,
            'NIC' => $NIC,
            'deliveryTime' => $deliveryTime,
            'status' => 'pending'
        ];

        return $this->insert($data);
    }

    public function getDriverId($driverID)
    {
        $data = ['driverId' => $driverID];

        return $this->first($data, []);
    }
    public function getDrivers($status){
        $sql = "Select * FROM $this->table WHERE status= :status";
        return $this->query($sql,['status'=>$status]);
    }
    public function getlastId($status="APPROVED")
    {
        $sql = "SELECT COUNT(*) AS row_count FROM $this->table WHERE status = :status";
        $result = $this->query($sql, ['status' => $status]);

      
        // If the result is an object, access the property using ->
        if (is_array($result) && isset($result[0])) {
            return $result[0]->row_count; // Access the property as an object
        }

        // Default return value if no result is found
        return 0;
    }

    public function notificationDriver($status="pending"){
        $sql = "SELECT driverId , driverName FROM $this->table WHERE status = :status LIMIT 5";
        return $this->query($sql,['status' => $status]);
    }
}
