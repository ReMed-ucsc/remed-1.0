<?php

class DashboardPage
{
    use Controller;

    public function __construct()
    {
        $this->protectRoute();
    }

    public function index()
    {
        // Protect the route
        // $this->protectRoute();

        // Get session data
        // $username = $this->getSession('isAdmin');
        // $userId = $this->getSession('user_id');
        // $authToken = $this->getSession('auth_token');


        // // Pass session data to the view
        // $data = [
        //     'username' => $username,
        //     'userId' => $userId,
        //     'authToken' => $authToken,
        // ];
        // $this->view('pharmacy/dashboardPage', $data);

        if (!isset($_SESSION['user_id'])) {
            redirect('login'); // or show an unauthorized message
            exit();
        }

        $pharmacyID = $_SESSION['user_id'];
        $patientModel = new OrderView;
        $patientCount = $patientModel->patientCount($pharmacyID);
        $orderCount = $patientModel->orderCount($pharmacyID);
        $monthlyIncome = $patientModel->monthlyIncome($pharmacyID);

        $this->view('pharmacy/dashboardPage', ['patientCount' => $patientCount, 'orderCount' => $orderCount, 'monthlyIncome' => $monthlyIncome]);
    }

    // add other methods like edit, update, delete, etc.
}
