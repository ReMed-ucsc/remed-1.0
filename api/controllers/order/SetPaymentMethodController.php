<?php

require_once BASE_PATH . '/app/models/MedicineOrder.php';
require_once BASE_PATH . '/app/models/OrderList.php';
require_once BASE_PATH . '/app/models/Patient.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class SetPaymentMethodController
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
                // Validate required fields
                if (isset($_GET['OrderID'], $_GET['paymentMethod'])) {
                    $orderID = $_GET['OrderID'];
                    $paymentMethod = $_GET['paymentMethod'];

                    $orderModel = new MedicineOrder();

                    // Update order status
                    $updateResult = $orderModel->setPaymentMethod($orderID, $paymentMethod);

                    if (!$updateResult) {
                        $result->setErrorStatus(false);
                        $result->setMessage("Order payment method set successfully.");
                        $response['result']['error'] = $result->isError();
                        $response['result']['message'] = $result->getMessage();
                        $response['data'] = ['orderID' => $orderID];
                    } else {
                        $result->setErrorStatus(true);
                        $result->setMessage($updateResult['message']);
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
