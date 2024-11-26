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

    public function edit($orderId)
    {
        $orderModel = new MedicineOrder();
        $orderMedicineModel = new OrderView();
        $medicineListModel = new OrderList();

        $order = $orderModel->getMedicineOrder($orderId);
        $orderMedicine = $orderMedicineModel->getOrderMedicines($orderId);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $productId = $_POST['productId'];
            $newQuantity = $_POST['quantity'];

            $data = ['quantity' => $newQuantity];
            $conditions = [
                'orderId' => $orderId,
                'productId' => $productId
            ];

            $medicineListModel->updateWithConditions($data, $conditions);

            redirect("order/edit/$orderId");
            exit;
        } else {
            $this->view('pharmacy/orderView', ['order' => $order, 'medicineList' => $orderMedicine, 'viewOnly' => false]);
        }
    }

    public function deleteItem($orderId)
    {
        $orderModel = new MedicineOrder();
        $orderMedicineModel = new OrderView();
        $medicineListModel = new OrderList();
        $order = $orderModel->getMedicineOrder($orderId);
        $orderMedicine = $orderMedicineModel->getOrderMedicines($orderId);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $productId = $_POST['delete'];

            // Delete the specific medicine from the order
            $conditions = [
                'orderId' => $orderId,
                'productId' => $productId
            ];

            $medicineListModel->deleteWithConditions($conditions);

            redirect("order/$orderId");
            exit;
        } else {
            $this->view('pharmacy/orderView', ['order' => $order, 'medicineList' => $orderMedicine, 'viewOnly' => true]);
        }
    }

    public function addItem($orderId)
    {
        $orderModel = new MedicineOrder();
        $orderMedicineModel = new OrderView();
        $medicineListModel = new OrderList();
        $order = $orderModel->getMedicineOrder($orderId);
        $orderMedicine = $orderMedicineModel->getOrderMedicines($orderId);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $productId = $_POST['medicineId'];
            $quantity = $_POST['quantity'];

            $data = [
                'OrderID' => $orderId,
                'ProductID' => $productId,
                'quantity' => $quantity
            ];

            $medicineListModel->insert($data);

            redirect("order/$orderId");
            exit;
        } else {
            $this->view('pharmacy/orderView', ['order' => $order, 'medicineList' => $orderMedicine, 'viewOnly' => true]);
        }
    }
}
