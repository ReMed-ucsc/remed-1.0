<?php

class IncomeView
{
    use Controller;


    public function __construct()
    {
        $this->protectRoute();
    }

    public function index()
    {
        //get session data
        $pharmacyId = $this->getSession('user_id');
        $authToken = $this->getSession('auth_token');

        date_default_timezone_set("Asia/Colombo");

        $month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
        $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

        $incomeModel = new MedicineOrder();
        $incomeData = $incomeModel->getIncome($pharmacyId, $month, $year);

        $expenseModel = new StockDataView;
        $stockData = $expenseModel->getMedicineStockPurchaseDetails($pharmacyId, $month, $year);

        //show($incomeData);

        $totalIncome = 0;
        foreach ($incomeData as $item) {
            $totalIncome = $totalIncome + $item->totalBill;
        }

        $this->setSession('totalIncome', $totalIncome);

        $totalExpenses = 0;
        foreach ($stockData as $item) {
            $totalExpenses += $item->purchaseCost;
        }

        //show($stockData);


        // echo "System Date: " . date('Y-m-d H:i:s') . "<br>";
        // echo "Month: " . $month . "<br>";
        // echo "Year: " . $year . "<br>";
        //exit;

        $data = [
            'userId' => $pharmacyId,
            'auth_token' => $authToken,
            'incomeData' => $incomeData,
            'expenses' => $stockData,
            'totalIncome' => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'orders' => $incomeData,
            'month' => $month,
            'year' => $year
        ];

        //show($data);

        $this->view('pharmacy/incomeView', $data);
    }
}
