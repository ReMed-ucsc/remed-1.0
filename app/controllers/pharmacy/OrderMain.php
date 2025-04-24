<?php

class OrderMain
{
    use Controller;

    public function __construct()
    {
        $this->protectRoute();
    }

    public function index()
    {
        $pharmacyID = $_SESSION['user_id'];

        $orderModel = new MedicineOrder();
        $orders = $orderModel->getOrdersByPharmacy($pharmacyID);

        // $orders = $orderModel->getOrderDetails();


        $this->View('pharmacy/orderMain', ['orders' => $orders]);
    }
}
