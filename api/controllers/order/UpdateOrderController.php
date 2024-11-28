<?php

require_once BASE_PATH . '/app/models/MedicineOrder.php';
require_once BASE_PATH . '/app/models/OrderList.php';
require_once BASE_PATH . '/app/models/Patient.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class UpdateOrderController
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
                file_put_contents('php://stderr', print_r($_POST, true));

                // Assuming you have received the multipart data
                $orderJson = $_POST['order']; // This is the JSON string part

                // Convert the JSON string back to an associative array
                $data = json_decode($orderJson, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    $result->setErrorStatus(true);
                    $result->setMessage("Invalid JSON input: " . json_last_error_msg());
                    $response['result']['error'] = $result->isError();
                    $response['result']['message'] = $result->getMessage();
                    echo json_encode($response);
                    return;
                }

                // Validate required fields
                if (isset($data['orderID'], $data['productIDs'], $data['quantities'])) {
                    $orderID = $data['orderID'];
                    $productIDs = $data['productIDs'];
                    $quantities = $data['quantities'];
                    $removedProductIDs = $data['removedProductIDs'] ?? [];

                    // Validate productIDs and quantities
                    if (count($productIDs) === count($quantities)) {
                        $orderModel = new MedicineOrder();
                        $orderListModel = new OrderList();

                        // Update order items
                        $orderListModel->updateOrderList($orderID, $productIDs, $quantities, $removedProductIDs);

                        $result->setErrorStatus(false);
                        $result->setMessage("Order updated successfully.");
                        $response['result']['error'] = $result->isError();
                        $response['result']['message'] = $result->getMessage();
                        $response['data'] = ['orderID' => $orderID];
                        echo json_encode($response);
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
