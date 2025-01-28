<?php

class Dashboard
{
    use Controller;

    public function index()
    {
        // Protect the route
        // $this->protectRoute();

        // Get session data
        $AdminID = $this->getSession('id');
        $adminEmail = $this->getSession('email');
        $authToken = $this->getSession('auth_token');
        $pharmacy = new pharmacy();
        $lastId = $pharmacy->getlastId();
         // Debugging step
        // die();

        // Get all pharmacies
        $AdminModel = new Admin();
        $admin = $AdminModel->findAll();

        if ($admin === false) {
            $data['error_message'] = 'Error loading pharmacy data. Please try again later.';
        } else {
            $data['admin'] = $admin;
        }
        // Pass session data to the view
        $data = [
            'email' => $adminEmail,
            'id' => $AdminID,
            'authToken' => $authToken,
            'admin' => $admin,
            'last_Id' => isset($lastId[0]->last_id) ? $lastId[0]->last_id : null
        ];

        $this->unsetSession('error_message');
        $this->unsetSession('success_message');

        $this->view('admin/dashboard', $data);
    }
    // add other methods like edit, update, delete, etc.
}
