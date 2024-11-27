<?php

class Dashboard
{
    use Controller;
    public function index()
    {
        // Protect the route
        $this->protectRoute();

        // Get session data
        $username = $this->getSession('isAdmin');
        $userId = $this->getSession('user_id');
        $authToken = $this->getSession('auth_token');


        // Pass session data to the view
        $data = [
            'username' => $username,
            'userId' => $userId,
            'authToken' => $authToken,
        ];
        $this->view('admin/dashboard', $data);
    }

    // add other methods like edit, update, delete, etc.
}
