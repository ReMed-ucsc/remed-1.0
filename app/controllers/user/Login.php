<?php

class Login
{
    use Controller;

    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new User;
            $arr['email'] = $_POST['email'];

            $row = $user->first($arr);

            if ($row) {
                // if ($row->password === $_POST['password']) {
                //     $_SESSION['USER'] = $row;
                //     redirect('home');
                // }

                if (password_verify($_POST['password'], $row->password)) {

                    $authToken = hash('sha384', microtime() . uniqid() . bin2hex(random_bytes(10)));
                    $user->updateToken($arr['email'], $authToken);

                    $this->setSession('USER', $row);
                    $this->setSession('user_id', $row->id);
                    $this->setSession('user_name', $row->name);
                    $this->setSession('auth_token', $authToken);

                    redirect('dashboard');
                    exit();
                }
            }

            $user->errors['email'] = "Wrong email or password";

            $data['errors'] = $user->errors;
        }

        $this->view('user/login', $data);
    }

    public function logout()
    {
        $this->destroySession();
        redirect('login');
        // header("Location: /login");
        exit();
    }
}
