<?php

class Dashboard
{
    use Controller;

    public function index()
    {
        // Protect the route
        $this->protectRoute();

        // Get session data
        $username = $this->getSession('user_name');
        $userId = $this->getSession('user_id');
        $authToken = $this->getSession('auth_token');

        // Get all users
        $userModel = new User();
        $users = $userModel->findAll();

        // Pass session data to the view
        $data = [
            'username' => $username,
            'userId' => $userId,
            'authToken' => $authToken,
            'users' => $users
        ];

        $this->view('user/home', $data);
    }

    public function create()
    {
        // Protect the route
        $this->protectRoute();

        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new User();
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];

            if ($user->validate($data)) {
                $user->registerUser($data['name'], $data['email'], $data['password']);
                redirect('dashboard');
                exit();
            } else {
                $data['errors'] = $user->errors;
            }
        }

        $this->view('user/create', $data);
    }

    public function edit($id)
    {
        // Protect the route
        $this->protectRoute();

        $userModel = new User();
        $user = $userModel->first(['id' => $id]);

        if (!$user) {
            redirect('dashboard');
            exit();
        }

        $data = ['user' => $user];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email']
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password'];
            }

            if ($userModel->validate($data)) {
                if (!empty($data['password'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                }
                $userModel->update($id, $data, 'id');
                redirect('dashboard');
                exit();
            } else {
                $data['errors'] = $userModel->errors;
            }
        }

        $this->view('user/edit', $data);
    }

    public function delete($id)
    {
        // Protect the route
        $this->protectRoute();

        $userModel = new User();
        $userModel->delete($id, 'id');
        redirect('dashboard');
        exit();
    }
}
