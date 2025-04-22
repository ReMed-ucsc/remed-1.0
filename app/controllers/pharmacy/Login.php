<?php

class Login
{
    use Controller;
    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['registered'])) {
            $data['success'] = "Thank you for registering with Remed!<br><br>

 We’ve received your form details, and your account will be processed within the next 3 days. Please check your email or WhatsApp for a confirmation message.<br><br>

We appreciate your patience and look forward to having you with us! ";
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new Pharmacy;
            $arr['email'] = $_POST['email'];

            $row = $user->first($arr);

            if ($row) {
                if (password_verify($_POST['password'], $row->password)) {

                    $authToken = hash('sha384', microtime() . uniqid() . bin2hex(random_bytes(10)));
                    $user->updateToken($arr['email'], $authToken);

                    $this->setSession('user_id', $row->PharmacyID);
                    $this->setSession('auth_token', $authToken);
                    $this->setSession('isAdmin', false);
                    $this->setSession('last_activity', time());

                    redirect('dashboardPage');
                    exit();
                }
            }

            $user->errors['email'] = "Wrong email or password";

            $data['errors'] = $user->errors;
        }
        $this->view('pharmacy/login', $data);
    }

    public function logout()
    {
        $this->destroySession();
        redirect('login');
        exit();
    }
}


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