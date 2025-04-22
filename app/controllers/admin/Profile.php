<?php

class Profile
{
    use Controller;
    public function index()
    {
        $id =$this-> getSession("id");
        $username = $this->getSession("username");
        $email = $this->getSession("email");
        $contactNo = $this->getSession("contactNo");

        $adminMOdel = new Admin();
        $msg = new Pharmacy();
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $msg->notification('pending');
        $admin= $adminMOdel->get_admin();
        
        $data=[
            'id'=> $id,
            'username'=> $username,
            'email'=> $email,
            'admin'=> $admin,
            'contactNo' => $contactNo,
            'notification'=> $Msg,
            'notificationDriver'=> $MsgDriver
        ];


        $this->view('admin/profile', $data);
    }
    public function edit($id){
        $this->protectRoute();

        $adminModel = new Admin();
        $msg = new Pharmacy();
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $msg->notification('pending');
        $admin = $adminModel->first(['id' => $id]);

        if (!$admin) {
            redirect('admin/profile');
            exit();
        }

        $data = [
            'admin' => $admin,
            'notification'=> $Msg,
            'notificationDriver'=> $MsgDriver
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'contactNo' => $_POST['contactNo']
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password'];
            }
          

            if ($adminModel->validate($data)) {
                if (!empty($data['password'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                }
                $adminModel->update($id, $data, 'id');
                redirect('admin/profile');
                exit();
            } else {
                $data['errors'] = $adminModel->errors;
            }
        }

        $this->view('admin/accountManage', $data);
    }

    // add other methods like edit, update, delete, etc.
}
