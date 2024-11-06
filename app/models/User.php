<?php

class User
{
    use Model;

    protected $table = 'users';
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

    public function getUserByEmail($email)
    {
        $data = ['email' => $email];
        return $this->first($data);
    }

    public function updateToken($email, $token)
    {
        $data = ['token' => $token];
        $this->update($email, $data, 'email');
    }

    public function registerUser($name, $email, $password)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
        return $this->insert($data);
    }
}
