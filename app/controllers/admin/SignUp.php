<?php

class SignUp
{
    use Controller;
    public function __construct(){
        $this->protectRoute();
    }
    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $admin = new Admin();

            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];

            if ($admin->validation($data)) {
                $admin->registerAdmin($data['username'], $data['email'], $data['contactNo'],$data['password']);
                redirect('admin/login'); // Redirect to the login page
                exit();
            } else {
                $data['errors'] = $admin->errors;
            }
        }

        $this->view('admin/signup', $data);
    }
}
