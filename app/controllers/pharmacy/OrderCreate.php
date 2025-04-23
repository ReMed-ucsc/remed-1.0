<?php

class OrderCreate
{
    use Controller;

    public function index()
    {
        $data['OrderID'] = isset($_GET['OrderID']) ? $_GET['OrderID'] : null;

        // If we have an order ID, fetch the order items
        if ($data['OrderID']) {
            $orderListModel = new OrderView();
            $data['orderDetails'] = $orderListModel->getOrderDetails($data['OrderID']);
            $data['orderItems'] = $orderListModel->getOrderMedicines($data['OrderID']);
            $data['totalPrice'] = $this->calculateTotalPrice($data['orderItems']);
        } else {
            $data['orderItems'] = [];
            $data['totalPrice'] = 0;
        }

        $this->view('pharmacy/orderCreate', $data);
    }

    public function createOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] != "POST" || !isset($_POST['medicineId']) || !isset($_POST['quantity'])) {
            redirect("orderCreate");
            return;
        }

        $productId = $_POST['medicineId'];
        $quantity = $_POST['quantity'];
        $pharmacyId = $_SESSION['user_id'];

        // Create a new order for unregistered patient
        $orderModel = new MedicineOrder();

        $patientId = 0; // Unregistered patient
        $destination = null;
        $pickup = 1;
        $prescription = null;
        $destinationLat = null;
        $destinationLong = null;

        $orderId = $orderModel->placeOrder(
            $patientId,
            $pickup,
            $destination,
            $destinationLat,
            $destinationLong,
            $pharmacyId,
            $prescription
        );

        if (!$orderId) {
            // Handle error
            redirect("orderCreate");
            return;
        }

        // Add medicine to order list
        $medicineListModel = new OrderList();
        $result = $medicineListModel->insert([
            'OrderID' => $orderId,
            'ProductID' => $productId,
            'quantity' => $quantity
        ]);

        redirect("orderCreate/?OrderID=$orderId");
    }

    public function addToOrder()
    {
        if (
            $_SERVER['REQUEST_METHOD'] != "POST" ||
            !isset($_POST['medicineId']) ||
            !isset($_POST['quantity']) ||
            !isset($_POST['orderId'])
        ) {
            redirect("orderCreate");
            return;
        }

        $productId = $_POST['medicineId'];
        $quantity = $_POST['quantity'];
        $orderId = $_POST['orderId'];

        // Add medicine to order list
        $medicineListModel = new OrderList();
        $result = $medicineListModel->insert([
            'OrderID' => $orderId,
            'ProductID' => $productId,
            'quantity' => $quantity
        ]);

        redirect("orderCreate/?OrderID=$orderId");
    }

    private function calculateTotalPrice($items)
    {
        $total = 0;
        foreach ($items as $item) {
            $total += $item->unitPrice * $item->quantity;
        }
        return $total;
    }

    public function removeItem()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['itemId']) && isset($_POST['orderId'])) {
            $itemId = $_POST['itemId'];
            $orderId = $_POST['orderId'];

            $medicineListModel = new OrderList();
            $medicineListModel->deleteItem($orderId, $itemId);

            redirect("orderCreate/?OrderID=$orderId");
        } else {
            redirect("orderCreate");
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

            redirect("orderCreate/?OrderID=$orderId");
        } else {
            redirect("orderCreate");
        }
    }
}
