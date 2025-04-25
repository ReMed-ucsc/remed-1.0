<?php

class Profile
{
    use Controller;
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
            'notificationDriver' => $MsgDriver
        ];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [
                'username' => $_POST['username'],
                'contactNo' => $_POST['contactNo']
                'email' => $_POST['email'],
                'contactNo' => $_POST['contactNo'],
                'password' => $_POST['password'] ?? '', // default empty if not provided
                'confirm_password' => $_POST['confirm_password'] ?? ''
            ];

            // Password and confirm password match check
            if (!empty($data['password']) && $data['password'] !== $data['confirm_password']) {
                $data['errors']['password'] = "Passwords do not match!";
            }

            if ($adminModel->validateAdmin($data)) {
            // Remove confirm_password from data before saving to DB
            unset($data['confirm_password']);

            if (empty($data['errors']) && $adminModel->validate($data)) {
                if (!empty($data['password'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                } else {
                    unset($data['password']); // if password empty, don't update it
                }

                $adminModel->update($id, $data, 'id');
                redirect('admin/profile');
                exit();
            } else {
                $data['admin'] = $admin; // retain the admin data to show in the form
                $data['notification'] = $Msg;
                $data['notificationDriver'] = $MsgDriver;
                $data['errors'] = $data['errors'] ?? []; // in case only password mismatch
                if (!empty($adminModel->errors)) {
                    $data['errors'] = array_merge($data['errors'], $adminModel->errors);
                }

            }
        }


        $this->view('admin/accountManage', $data);
    }

    // add other methods like edit, update, delete, etc.
}
