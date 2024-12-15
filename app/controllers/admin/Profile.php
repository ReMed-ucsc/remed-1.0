<?php

class Profile
{
    use Controller;
    public function index()
    {
        $id =$this-> getSession("id");
        $username = $this->getSession("username");
        $email = $this->getSession("email");

        $adminMOdel = new Admin();
        $admin= $adminMOdel->get_admin();
        
        $data=[
            'id'=> $id,
            'username'=> $username,
            'email'=> $email,
            'admin'=> $admin
        ];


        $this->view('admin/profile', $data);
    }
    public function edit($id){
        $this->protectRoute();

        $adminModel = new Admin();
        $admin = $adminModel->first(['id' => $id]);

        if (!$admin) {
            redirect('admin/profile');
            exit();
        }

        $data = ['admin' => $admin];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email']
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
