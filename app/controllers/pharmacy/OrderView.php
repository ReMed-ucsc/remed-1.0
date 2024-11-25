<?php

class OrderView
{
    use Controller;
    public function index($orderId)
    {
        $orderModel = new Order();
        $order = $orderModel->getMedicineOrder($orderId);
        $this->view('pharmacy/orderView', ['order' => $order]);
    }

    // add other methods like edit, update, delete, etc.
}
