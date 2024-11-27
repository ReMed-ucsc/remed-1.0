<?php

class Login
{
    use Controller;
    public function index()
    {
        $data = [];

        $user = new Admin;


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new Admin;
            $arr['email'] = $_POST['email'];

            $row = $user->first($arr);

            if ($row) {
                if (password_verify($_POST['password'], $row->password)) {

                    $authToken = hash('sha384', microtime() . uniqid() . bin2hex(random_bytes(10)));
                    $user->updateToken($arr['email'], $authToken);

                    $this->setSession('USER', $row);
                    $this->setSession('user_id', $row->email);
                    $this->setSession('auth_token', $authToken);
                    $this->setSession('isAdmin', true);

                    redirect('admin/dashboard');
                    exit();
                }
            }

            $user->errors['email'] = "Wrong email or password";

            $data['errors'] = $user->errors;
        }


        $this->view('admin/login', $data);
    }

    public function logout()
    {
        $this->destroySession();
        redirect('admin/login');
        exit();
    }
}


// admin account create
 // $data = [
//     'email' => $_POST['email'],
//     'password' => $_POST['password'],
//     'level' => 1
// ];

// if ($user->validate($data)) {
//     $user->registerUser($data['name'], $data['email'], $data['password']);
//     redirect('login');
//     exit();
// } else {
//     $data['errors'] = $user->errors;
// }