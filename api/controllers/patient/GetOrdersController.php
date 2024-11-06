<?php

require_once BASE_PATH . '/app/models/Patient.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class GetOrdersController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';

        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $authToken = $matches[1];

            $patientModel = new Patient();
            $patient = $patientModel->first(['token' => $authToken]);

            if ($patient) {
                $orderList = $patientModel->getOrderHistory($patient->id);

                if ($orderList == null) {
                    $result->setErrorStatus(true);
                    $result->setMessage("No orders found");
                } else {
                    $response['data'] = $orderList;

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

        $response['error'] = $result->isError();
        $response['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
