<?php

class Admin extends User
{
    use Model;

    protected $table = 'admin';
    protected $allowedColumns = ['id','username', 'email', 'password', 'token', 'level'];

    // Validation method
    public function validation($data)
    {
        $this->errors = []; // Reset errors

        // Validate username
        if (empty($data['username'])) {
            $this->errors['username'] = "User name is required.";
        }

        // Validate email
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format.";
        }

        // Validate password
        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required.";
        }

        return empty($this->errors); // Pass if no errors
    }

    // Method to register an admin
    public function registerAdmin($username, $email, $password)
    {
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash password for security
            'token' => bin2hex(random_bytes(16)), // Generate a random 32-character token
        ];

        return $this->insert($data); // Save to database
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

    public function updateFcmToken($email, $fcmToken)
    {
        $data = ['fcmToken' => $fcmToken];
        $this->update($email, $data, 'email');
    }
    public function get_admin(){
        $sql = "Select * FROM $this->table LIMIT 1";
        $res =  $this->query($sql);
        if(is_array($res) && count($res)){
            return $res[0];
        }
        return false;
    }
    //  public function get_admin($id)
    // {
    //     $data = ['id' => $id];
    //     return $this->first($data, []);
    // }

}