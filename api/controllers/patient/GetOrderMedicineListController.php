<?php

require_once BASE_PATH . '/app/models/Patient.php';
require_once BASE_PATH . '/app/models/OrderView.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class GetOrderMedicineListController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $_SERVER['HTTP_AUTH'] ?? '';

        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $authToken = $matches[1];

            $patientModel = new Patient();
            $orderModel = new OrderView();
            $orderID = $data['orderID'] ?? '';

            if (empty($orderID)) {
                $result->setErrorStatus(true);
                $result->setMessage("Insufficient parameters");
            } else {
                try {
                    $patient = $patientModel->first(['token' => $authToken]);

                    // show($patient);
                    if ($patient) {
                        $orderMedicineList = $orderModel->getOrderMedicines($orderID);
                        // $orderMedicineList = $patientModel->getOrderMedicines($orderID, $patient->PatientID);

                        if ($orderMedicineList == null) {
                            $result->setErrorStatus(true);
                            $result->setMessage("No medicines selected for the order.");
                        } else {
                            $response['data'] = $orderMedicineList;

                            $result->setErrorStatus(false);
                            $result->setMessage("Order Medicine List ready");
                        }
                    } else {
                        $result->setErrorStatus(true);
                        $result->setMessage("Invalid auth token");
                    }
                } catch (Exception $e) {
                    $result->setErrorStatus(true);
                    $result->setMessage("Something went wrong " . $e->getMessage());
                }
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
