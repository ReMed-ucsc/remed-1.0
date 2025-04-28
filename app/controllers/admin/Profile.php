<?php

class Profile
{
    use Controller;

    public function __construct(){
        $this->protectRoute();
    }
    public function index()
    {
        $id = $this->getSession("id");
        $username = $this->getSession("username");
        $email = $this->getSession("email");
        $contactNo = $this->getSession("contactNo");

        $adminMOdel = new Admin();
        $msg = new Pharmacy();
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $msg->notification('pending');
        $admin = $adminMOdel->get_admin();

        $data = [
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'admin' => $admin,
            'contactNo' => $contactNo,
            'notification' => $Msg,
            'notificationDriver' => $MsgDriver
        ];


        $this->view('admin/profile', $data);
    }
    public function edit($id)
    {
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
            'notification' => $Msg,
            'notificationDriver' => $MsgDriver,
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = $_POST['username'];
            $contactNo = $_POST['contactNo'];
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if (!empty($password) && $password !== $confirm_password) {
                $data['errors']['confirm_password'] = "Passwords do not match.";
            }

            $updateData = [
                'username' => $username,
                'contactNo' => $contactNo
            ];
            if(empty($username)){
                $data['errors']['username']="username required";
            }
            if(empty($contactNo)){
                $data['errors']['contactNo']="Contact required";
            }

            if (!empty($password) && empty($data['errors'])) {
                $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            if (empty($data['errors']) && $adminModel->validateAdmin($updateData)) {
                $adminModel->update($id, $updateData, 'id');
                redirect('admin/profile');
                exit();
            } else {
                $data['errors'] = array_merge($data['errors'], $adminModel->errors ?? []);
            }
        }

        $this->view('admin/accountManage', $data);
    }


}
