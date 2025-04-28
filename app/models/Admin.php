<?php


class Admin extends User
{
    use Model;

    protected $table = 'admin';

    protected $allowedColumns = ['id', 'username', 'email', 'contactNo', 'password', 'token', 'token_expiry'];


    public function validation($data)
    {
        $this->errors = []; 

        
        if (empty($data['username'])) {
            $this->errors['username'] = "User name is required.";
        }

        if (empty($data['contactNo'])){
            $this ->errors['contactNo']="Contact No is required.";
        }

        
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format.";
        }

        
        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required.";
        }

        return empty($this->errors); 
    }

    public function registerAdmin($username, $email, $contactNo, $password)
    {
        $data = [
            'username' => $username,
            'email' => $email,
            'contactNo'=>$contactNo,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash password for security
            'token' => bin2hex(random_bytes(16)), // Generate a random 32-character token
        ];

        return $this->insert($data); 
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
    public function get_admin()
    {
        $sql = "Select * FROM $this->table LIMIT 1";
        $res = $this->query($sql);
        if (is_array($res) && count($res)) {
            return $res[0];
        }
        return false;
    }
    public function findByEmail($email) {
        return $this->get_row("SELECT * FROM $this->table WHERE email = ?", [$email]);
    }

    public function findByToken($token) {
        return $this->get_row("SELECT * FROM $this->table WHERE token = ?", [$token]);
    }

    public function saveResetToken($email, $token) {
        $query = "UPDATE $this->table SET token = :token, token_expiry = NOW() + INTERVAL 10 MINUTE WHERE email = :email";
        return $this->query($query, ['token' => $token, 'email' => $email]);
    }

    public function resetPassword($token, $password) {
        $query = "UPDATE $this->table SET password = :password, token_expiry = NULL 
                  WHERE token = :token AND token_expiry > NOW()";
        return $this->query($query, ['password' => $password, 'token' => $token]);
    }
    public function validateAdmin($data)
    {
        $this->errors = [];

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

}