<?php

require_once BASE_PATH . '/app/models/Patient.php';
require_once BASE_PATH . '/app/models/OrderView.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class GetOrderController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $_SERVER['HTTP_AUTH'] ?? '';

        if (isset($_GET['OrderID'])) {
            $orderID = $_GET['OrderID'];

            if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                $authToken = $matches[1];

                $patientModel = new Patient();
                $patient = $patientModel->first(['token' => $authToken]);

                if ($patient) {
                    $orderModel = new OrderView();
                    $orderList = $orderModel->getOrder($orderID, $patient->PatientID);

                    if ($orderList == null) {
                        $result->setErrorStatus(true);
                        $result->setMessage("No orders found");
                    } else {
                        // Separate order details and product details
                        // categorize statuse according to the order status categories in 
                        $status = $orderModel->getStatusName($orderList[0]->status);

                        $orderDetails = [
                            'OrderID' => $orderList[0]->OrderID,
                            'date' => $orderList[0]->date,
                            'status' => $status,
                            'pickup' => $orderList[0]->pickup,
                            'destination' => $orderList[0]->destination,
                            'PatientID' => $orderList[0]->PatientID,
                            'patientName' => $orderList[0]->patientName,
                            'PharmacyID' => $orderList[0]->PharmacyID,
                            'pharmacyName' => $orderList[0]->name
                        ];

                        $productDetails = [];
                        foreach ($orderList as $order) {
                            $productDetails[] = [
                                'ProductID' => $order->ProductID,
                                'ProductName' => $order->ProductName
                            ];
                        }

                        $response['data'] = [
                            'orderDetails' => $orderDetails,
                            'productDetails' => $productDetails
                        ];

                        $result->setErrorStatus(false);
                        $result->setMessage("Order List ready");
                    }
                } else {
                    $result->setErrorStatus(true);
                    $result->setMessage("Invalid auth token");
                }
            } else {
                $result->setErrorStatus(true);
                $result->setMessage("Invalid Authorization header format");
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("OrderID is required");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
