<?php

class OrderCreate
{
    use Controller;
    public function index()
    {
        $data['OrderID'] = isset($_GET['OrderID']) ? $_GET['OrderID'] : null;
        $data['error'] = '';

        $this->view('pharmacy/orderCreate', $data);
    }

    public function create()
    {
        $pharmacyId = $_SESSION['user_id'];
        $data['OrderID'] = isset($_GET['OrderID']) ? $_GET['OrderID'] : null;
        $data['error'] = '';

        $medicineListModel = new OrderList();

        if (isset($_GET['OrderID'])) {
            $orderId = $_GET['OrderID'];

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $productId = $_POST['medicineId'];
                $quantity = $_POST['quantity'];

                $data = [
                    'OrderID' => $orderId,
                    'ProductID' => $productId,
                    'quantity' => $quantity
                ];

                $medicineListModel->insert($data);
                redirect("orderCreate/?OrderID=$orderId", $data);
                exit;
            }
            redirect("orderCreate/?OrderID=$orderId", $data);
        } else {
            $orderModel = new MedicineOrder();

            $patientId = 0; // unregistered patient
            $destination = null;
            $pickup = 1;
            $prescription = null;

            $orderId = $orderModel->placeOrder($patientId, $pickup, $destination, $pharmacyId, $prescription);

            if ($orderId) {
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $productId = $_POST['medicineId'];
                    $quantity = $_POST['quantity'];

                    $data = [
                        'OrderID' => $orderId,
                        'ProductID' => $productId,
                        'quantity' => $quantity
                    ];

                    $medicineListModel->insert($data);

                    redirect("orderCreate/?OrderID=$orderId");
                    exit;
                }
            } else {
                $data['error'] = "Failed to create order.";
                $this->view('pharmacy/orderCreate', $data);
            }
        }
    }
}
