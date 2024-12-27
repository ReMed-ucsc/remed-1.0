<?php

class Driver extends User
{
    use Model;

    protected $table = 'driver';
    protected $allowedColumns = ['driverID','vehicalLicenseNo','document', 'driverName', 'email', 'password', 'token', 'telNo', 'deliveryTime', 'fcmToken'];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['driverName'])) {
            $this->errors['driverName'] = 'name is required';
        } 
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $$this->errors['email'] = 'Invalid email address';
        }

        // if (empty($data['password'])) {
        //     $this->errors['password'] = 'Password is required';
        // }

        // if (empty($data['fcmToken'])) {
        //     $this->errors['fcmToken'] = 'FCm token is required';
        // }

        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    public function getDriverByEmail($email)
    {
        $data = ['email' => $email];
        return $this->first($data);
    }

    public function registerDriver($name, $email, $password)
    {
        $data = [
            'driverName' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        return $this->insert($data);
    }

    public function getDriverId($driverID)
    {
        $data = ['driverID' => $driverID];

        return $this->first($data, []);
    }
    public function getDrivers()
    {
        $sql = "Select * FROM $this->table";
        return $this->query($sql);
    }

    // public function getLastInsertedId()
    // {
    //     $sql = "SELECT MAX(driverID) AS last_id FROM $this->table";
    //     $result = $this->query($sql);

    //     // echo "Last ID from database: ";
    //     // var_dump($result);
    //     // Return the last ID or 0 if the table is empty
    //     return $result[0]['last_id'] ?? 0;
    // }
}

