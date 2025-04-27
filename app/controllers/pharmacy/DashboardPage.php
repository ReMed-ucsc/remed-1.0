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
        $pharmacyModel = new Pharmacy();
        $pharmacyName = $pharmacyModel->getPharmacyById($pharmacyID);
        $patientCount = $patientModel->patientCount($pharmacyID);
        $orderCount = $patientModel->orderCount($pharmacyID);
        $monthlyIncome = $patientModel->monthlyIncome($pharmacyID);

        $payments = $patientModel->getPayment($pharmacyID);



        $drugModel = new DrugInventory();
        $orderViewModel = new OrderView();
        $drug = new Drug();


        $stockLevels = $drugModel->getStockLevelCountsArray($pharmacyID);
        $income = $orderViewModel->getLast7DaysIncome($pharmacyID);
        $patientVisit = $orderViewModel->patientVisitWeekly($pharmacyID);
        $medicineCategory = $drug->getMedicineCategoryChartData();
        $totalIncome = $this->getSession('totalIncome');
        $data = [
            'totalIncome' => $totalIncome
        ];
        $ongoingOrder = $patientModel->ongoingOrderCount($pharmacyID);
        $ongoingOrderCount = $ongoingOrder[0]->ongoingOrderCount ?? 0;


        $this->view('pharmacy/dashboardPage', ['patientCount' => $patientCount, 'stockLevels' => $stockLevels,  'orderCount' => $orderCount, 'monthlyIncome' => $monthlyIncome, 'payments' => $payments, 'income' => $income, 'patientVisit' => $patientVisit, 'medicineCategory' => $medicineCategory, 'pharmacyName' => $pharmacyName, 'data' => $data, 'ongoingOrderCount' => $ongoingOrderCount]);
    }

    // add other methods like edit, update, delete, etc.
}
