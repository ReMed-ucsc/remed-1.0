<?php

class Driver extends User
{
    use Model;

    protected $table = 'driver';
    protected $allowedColumns = ['DriverID', 'driverName', 'email', 'password', 'token', 'phone', 'address', 'fcmToken'];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['name'])) {
            $this->errors['email'] = 'Email is required';
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $$this->errors['email'] = 'Invalid email address';
        }

        if (empty($data['password'])) {
            $this->errors['password'] = 'Password is required';
        }

        if (empty($data['fcmToken'])) {
            $this->errors['fcmToken'] = 'FCm token is required';
        }

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
        $data = ['DriverID' => $driverID];

        return $this->first($data, []);
    }
}