<?php

class Order
{
    use Controller;
    public function index($orderId)
    {
        $orderModel = new MedicineOrder();
        $orderMedicineModel = new OrderView();
        $order = $orderModel->getMedicineOrder($orderId);
        $orderMedicine = $orderMedicineModel->getOrderMedicines($orderId);
        $this->view('pharmacy/orderView', ['order' => $order, 'medicineList' => $orderMedicine, 'viewOnly' => true]);
    }

    // add other methods like edit, update, delete, etc.
    public function edit($orderId)
    {
        $orderModel = new MedicineOrder();
        $orderMedicineModel = new OrderView();
        $order = $orderModel->getMedicineOrder($orderId);
        $orderMedicine = $orderMedicineModel->getOrderMedicines($orderId);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $orderMedicine = [
                'quantity' => $_POST['quantity'],
            ];
        }
        $this->view('pharmacy/orderView', ['order' => $order, 'medicineList' => $orderMedicine, 'viewOnly' => false]);
    }
}
