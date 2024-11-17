<?php

require_once BASE_PATH . '/app/models/MedicineOrder.php';
require_once BASE_PATH . '/app/models/OrderList.php';
require_once BASE_PATH . '/app/models/Patient.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class CreateOrderController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        // Fetch headers
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $_SERVER['HTTP_AUTH'] ?? '';

        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $authToken = $matches[1];

            $patientModel = new Patient();
            $patient = $patientModel->first(['token' => $authToken]);

            if ($patient) {
                // Decode JSON input
                $data = json_decode(file_get_contents('php://input'), true);

                // Validate required fields
                if (isset($data['productIDs'], $data['quantities'], $data['destination'], $data['pharmacyID'])) {
                    $productIDs = $data['productIDs'];
                    $quantities = $data['quantities'];
                    $pickup = $data['pickup'] ? 1 : 0;
                    $destination = $data['destination'];
                    $pharmacyID = $data['pharmacyID'];

                    // Validate productIDs and quantities
                    if (count($productIDs) === count($quantities)) {
                        $orderModel = new MedicineOrder();
                        $orderListModel = new OrderList();

                        // Create order
                        $orderID = $orderModel->placeOrder($patient->PatientID, $pickup, $destination, $pharmacyID);

                        if ($orderID) {
                            // Set order items
                            $orderListModel->setOrderList($orderID, $productIDs, $quantities);

                            $result->setErrorStatus(false);
                            $result->setMessage("Order created successfully");
                            $response['data'] = ['orderID' => $orderID];
                        } else {
                            $result->setErrorStatus(true);
                            $result->setMessage("Failed to create order. Retuned order ID : " . $orderID);
                        }
                    } else {
                        $result->setErrorStatus(true);
                        $result->setMessage("Mismatch between product IDs and quantities");
                    }
                } else {
                    $result->setErrorStatus(true);
                    $result->setMessage("Missing required fields");
                }
            } else {
                $result->setErrorStatus(true);
                $result->setMessage("Invalid auth token");
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("Invalid Authorization header format");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
