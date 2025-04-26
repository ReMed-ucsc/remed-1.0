<?php

class Login
{
    use Controller;

    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $admin = new Admin;
            $arr['email'] = $_POST['email'];

            $row = $admin->first($arr);

            if ($row) {
                if (password_verify($_POST['password'], $row->password)) {

                    $authToken = hash('sha384', microtime() . uniqid() . bin2hex(random_bytes(10)));
                    $admin->updateToken($arr['email'], $authToken);

                    $this->setSession('ADMIN', $row);
                    $this->setSession('id', $row->id);
                    $this->setSession('email', $row->email);
                    $this->setSession('username', $row->username);
                    $this->setSession('auth_token', $authToken);
                    $this->setSession('isAdmin', true);
                    $this->setSession('last_activity', time());


                    redirect('admin/dashboard');
                    exit();
                }
                else{
                    $admin->errors['password']= "Password is Wrong. Enter Correct Password";

                }
            }else{
                $admin->errors['email'] = "Email is Wrong .Please Enter Correct Email";
            }

            $data['errors'] = $admin->errors;
        }

        $this->view('admin/login', $data);
    }

    public function logout()
    {
        $this->destroySession();
        redirect('admin/login');

        exit();
    }

    public function edit($id)
    {
        $adminModel = new Admin();
        $admin = $adminModel->first(['id' => $id]);

        if (!$admin) {
            redirect('admin/Dashboard');
            exit();
        }

        $data = ['admin' => $admin];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [
                $name = $_POST['name'],
                $email = $_POST['email'],
                $token = $_POST['token'],
                $password = $_POST['password'],
                $confirm = $_POST['confirm']
            ];
            
            if ($password !== $confirm) {
                $error = "Passwords do not match.";
                $token = htmlspecialchars($token);
                redirect('admin/AccountManage');
                return;
            }
            if ($adminModel->validate($data)) {
                $adminModel->update($id, $data, 'id');
                redirect('admin/Dashbord');
                exit();
            } else {
                $data['error'] = $adminModel->errors;
            }

            $this->view('admin/dashboard', $data);
        }
    }
    // public function forgetPassword(){
    //     $admin=new Admin();

    //     $this->view('admin/forgetPassword');
    // }
    // public function forgetPasswordReset(){
    //     $admin=new Admin();

    //     $this->view('admin/forgetPasswordReset');
    // }
    // public function showResetForm()
    // {
    //     $admin = new Admin;
    //     $token = $_GET['token'] ?? '';
        
    //     if (!$token || !$admin->isValidResetToken($token)) {
    //         echo "Invalid or expired token.";
    //         return;
    //     }

    //     require BASE_PATH . '/app/views/admin/forgetPasswordReset.view.php';
    // }


    // public function handleReset()
    // {
    //     $admin = new Admin;
    //     $token = $_POST['token'] ?? '';
    //     $password = $_POST['password'] ?? '';
    //     $confirm = $_POST['confirm_password'] ?? '';


    //     if ($password !== $confirm) {
    //         $error = "Passwords do not match.";
    //         $token = htmlspecialchars($token);
    //         require BASE_PATH . '/app/views/admin/forgetPasswordReset.view.php';
    //         return;
    //     }

    //     $user = $admin->findByResetToken($token);
    //     if (!$user) {
    //         echo "Invalid or expired token.";
    //         return;
    //     }

    //     $admin->updatePassword($user->id, password_hash($password, PASSWORD_DEFAULT));
    //     $admin->clearResetToken($user->id);

    //     redirect('admin/login?reset=success');

    // }

}
