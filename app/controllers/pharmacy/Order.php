<?php

require_once BASE_PATH . '/api/controllers/utilis/DeliveryUtility.php';

class Order
{
    use Controller;

    public function __construct()
    {
        $this->protectRoute();
    }

    public function index($orderId)
    {

        $orderModel = new MedicineOrder();
        $orderMedicineModel = new OrderView();
        $orderCommentModel = new OrderComment();

        if ($orderModel->checkPharmacyOrder($orderId, $_SESSION['user_id']) == false) {
            redirect("orderMain");
            exit;
        }

        $order = $orderModel->getMedicineOrder($orderId);
        $orderStatus = $orderModel->getStatusName($order->status);
        $orderMedicine = $orderMedicineModel->getOrderMedicines($orderId);
        $orderComments = $orderCommentModel->getCommentsByOrder($orderId);

        $orderPrescription = $orderModel->getPrescription($orderId);

        $this->view('pharmacy/orderView', ['order' => $order, 'status' => $orderStatus, 'medicineList' => $orderMedicine, 'comments' => $orderComments, 'prescription' => $orderPrescription, 'viewOnly' => true]);
    }

    public function edit($orderId)
    {
        $orderModel = new MedicineOrder();
        $orderMedicineModel = new OrderView();
        $medicineListModel = new OrderList();
        $orderCommentModel = new OrderComment();

        if ($orderModel->checkPharmacyOrder($orderId, $_SESSION['user_id']) == false) {
            redirect("orderMain");
            exit;
        }

        $order = $orderModel->getMedicineOrder($orderId);
        $orderStatus = $orderModel->getStatusName($order->status);
        $orderMedicine = $orderMedicineModel->getOrderMedicines($orderId);
        $orderComments = $orderCommentModel->getCommentsByOrder($orderId);


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

            $this->view('pharmacy/orderView', ['order' => $order, 'status' => $orderStatus, 'medicineList' => $orderMedicine, 'comments' => $orderComments, 'viewOnly' => false]);
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

    public function updateOrderStatus($orderId, $status, $paymentMethod = null)
    {
        if ($paymentMethod) {
            $orderModel = new MedicineOrder();
            $orderModel->setPaymentMethod($orderId, $paymentMethod);
        }
        if ($orderId && $status) {
            $orderModel = new MedicineOrder();
            $orderModel->updateOrderStatus($orderId, $status);

            if ($status == 'WP') {
                $this->confirmOrder($orderId);
            }

            redirect("order/$orderId");
        } else {
            redirect("order");
        }
    }

    public function confirmOrder($orderId)
    {
        $orderModel = new MedicineOrder();
        $utilityModel = new DeliveryUility();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $orderId = $_POST['orderId'];
            $status = 'W';

            $status = $orderModel->getStatusName('Q');

            $orderModel->updateOrderStatus($orderId, $status);

            //add the logic to only execute if the order is to be delivered
            //check if the order is store pickup
            $utilityModel->sendDetailstoDriver($orderId);

            //redirect to all orderes viewwing page 
            //change to appropiate redirection
            redirect("orderMain");
            exit;
        }

        redirect("orderMain");
    }
}
