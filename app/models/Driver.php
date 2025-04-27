<?php

class Driver extends User
{
    use Model;

    protected $table = 'driver';

    protected $allowedColumns = [
        'driverID',
        'vehicalLicenseNo',
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
        'status',
        'otp',
        'otpExpireTime',
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

    public function registerDriver($name, $email, $password, $dob, $tellNo, $NIC, $deliveryTime, $vehicalNumber)
    {
        $data = [
            'driverName' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'dob' => $dob,
            'telNo' => $tellNo,
            'NIC' => $NIC,
            'deliveryTime' => $deliveryTime,
            'status' => 'pending',
            'vehicalLicenseNo' => $vehicalNumber
        ];

        return $this->insert($data);
    }

    public function getDriverId($driverID)
    {
        $data = ['driverID' => $driverID];

        return $this->first($data, []);
    }
    public function getDrivers($status)
    {
        $sql = "Select * FROM $this->table WHERE status= :status";
        return $this->query($sql, ['status' => $status]);
    }

    public function resetPassword($driverID, $password)
    {
        $data = [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        return $this->update($driverID, $data, 'DriverID');
    }
    public function getlastId($status = "APPROVED")
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

    public function notificationDriver($status = "pending")
    {
        $sql = "SELECT driverId , driverName FROM $this->table WHERE status = :status LIMIT 5";
        return $this->query($sql, ['status' => $status]);
    }


    public function otpAdd($driverID, $otp, $expireTime)
    {
        $data = [
            'otp' => $otp,
            'otpExpireTime' => $expireTime
        ];

        return $this->update($driverID, $data, 'DriverID');
    }

    public function verifyToken($driverID, $token)
    {
        $query = "SELECT * FROM driver WHERE driverID = :driverId";
        $result = $this->query(($query), ['driverId' => $driverID]);

        if ($result) {
            $result = $result[0];
            if ($result->token == $token) {
                return true;
            }
        }

        return false;
    }

    public function updataProfile($driverId, $data)
    {
        return $this->update($driverId, $data, 'driverId');
    }

    public function getProfile($driverId)
    {
        $data = [
            'driverId' => $driverId
        ];

        $columns = [
            'driverName',
            'email',
            'dob',
            'telNo',
            'deliveryTime',
            'vehicalLicenseNo',
            'status'
        ];

        $conditions = [
            'driverId' => $driverId
        ];

        return $this->selectWhere($columns, $conditions, []);
    }

    public function updateProfile($driverId, $name, $vehicalNumber, $telNo)
    {
        $data = [
            'driverName' => $name,
            'vehicalLicenseNo' => $vehicalNumber,
            'telNo' => $telNo
        ];

        return $this->update($driverId, $data, 'driverID');
    }

    public function rejectDriver($id)
    {
        $sql = "UPDATE $this->table SET status = 'REJECT' WHERE driverID = :id";
        return $this->query($sql, ['id' => $id]);
    }
    public function existingDriver($license){
        $sql="SELECT driverID FROM $this->table WHERE vehicalLicenseNo = :vehicalLicenseNo";
        $result= $this->query($sql,['vehicalLicenseNo'=>$license]);
        return $result;
    }
}
