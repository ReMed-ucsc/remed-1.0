<?php

class User
{
    use Model;

    protected $table = 'users';
    protected $allowedColumns = ['name', 'email', 'password', 'token'];

    public function validate($data)
    {
        $this->errors = [];

        // Validate email
        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email address";
        } else if ($this->emailExists($data['email'])) {
            $this->errors['email'] = "Email is already taken";
        }

        // Validate password
        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required";
        } else if (strlen($data['password']) < 8) {
            $this->errors['password'] = "Password must be at least 8 characters long";
        } else if (!preg_match('/[A-Z]/', $data['password'])) {
            $this->errors['password'] = "Password must contain at least one uppercase letter";
        } else if (!preg_match('/[a-z]/', $data['password'])) {
            $this->errors['password'] = "Password must contain at least one lowercase letter";
        } else if (!preg_match('/[0-9]/', $data['password'])) {
            $this->errors['password'] = "Password must contain at least one number";
        } else if (!preg_match('/[\W]/', $data['password'])) {
            $this->errors['password'] = "Password must contain at least one special character";
        }

        return empty($this->errors);
    }

    public function emailExists($email)
    {
        $user = $this->first(['email' => $email]);
        return $user != null;
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
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        return $this->insert($data);
    }
}
