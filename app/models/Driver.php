<?php

class Driver extends User
{
    use Model;

    protected $table = 'driver';

    protected $allowedColumns = [
        'DriverID',
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
        $data = ['driverID' => $driverID];

        return $this->first($data, []);
    }
    public function getDrivers($status){
        $sql = "Select * FROM $this->table WHERE status= :status";
        return $this->query($sql,['status'=>$status]);
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

