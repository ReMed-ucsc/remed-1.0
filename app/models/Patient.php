<?php

class Patient extends User
{
    use Model;
    // use User;

    protected $table = 'patient';
    protected $allowedColumns = ['patientName', 'email', 'password', 'token'];

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
            'patientName' => $name,
            'email' => $email,
            'password' => $password
        ];
        return $this->insert($data);
    }
}
