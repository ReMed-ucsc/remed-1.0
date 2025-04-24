<?php

class SignUp
{
    use Controller;

    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $admin = new Admin();

            // Collect data from the form
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];

            // Validate data
            if ($admin->validation($data)) {
                $admin->registerAdmin($data['username'], $data['email'], $data['contactNo'],$data['password']);
                redirect('admin/login'); // Redirect to the login page
                exit();
            } else {
                // Pass validation errors to the view
                $data['errors'] = $admin->errors;
            }
        }

        // Load the signup view
        $this->view('admin/signup', $data);
    }
}
