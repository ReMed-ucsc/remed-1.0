<?php

class Signup
{
    use Controller;
    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new User;
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];

            if ($user->validate($data)) {
                $user->registerUser($data['name'], $data['email'], $data['password']);
                redirect('login');
                exit();
            } else {
                $data['errors'] = $user->errors;
            }
        }


        $this->view('user/signup', $data);
    }
}
