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
            }


            $admin->errors['email'] = "Wrong email or password";

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

    public function edit($id){
        $adminModel= new Admin();
        $admin=$adminModel->first(['id'=>$id]);

        if(!$admin){
            redirect('admin/Dashboard');
            exit();
        }

        $data = ['admin'=>$admin];

        if($_SERVER['REQUEST_METHOD']=="POST"){
            $data=[
                'name'=> $_POST['name'],
                'email'=>$_POST['email'],
                'password'=>$_POST['password']
            ];

            if($adminModel->validate($data)){
                $adminModel->update($id,$data,'id');
                redirect('admin/Dashbord');
                exit();
            }
            else{
                $data['error']=$adminModel->errors;
            }

            $this->view('admin/accountManage',$data);
        }
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