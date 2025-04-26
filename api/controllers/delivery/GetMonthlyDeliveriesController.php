<?php

require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/models/Delivery.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class GetMonthlyDeliveriesController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON input']);
            return;
        } else {
            //echo json_encode($data);
        }

        $token = $data['auth_token'];
        $driverId = $data['driverId'];
        $month = $data['month'];

        if (empty($token) || empty($driverId)) {
            http_response_code(400);
            $result->setErrorStatus(true);
            $result->setMessage("Order ID and token are required");
        } else {

            $driverModel = new Driver();
            $tokenStatus = $driverModel->verifyToken($driverId, $token);

            if (!$tokenStatus) {
                http_response_code(401);
                $result->setErrorStatus(true);
                $result->setMessage("Invalid token");
            } else {
                $deliveryModel = new Delivery();

                if (empty($month)) {
                    $month = date('n');
                }

                $delivery = $deliveryModel->getMonthlyDeliveries($driverId, $month);

                if (empty($delivery)) {
                    $delivery = array(
                        array(
                            'driverId' => 0,
                            'totalDeliveries' => 0
                        )
                    );
                }

                $response['totalDelivery'] = $delivery;
                $result->setErrorStatus(false);
                $result->setMessage("data found for month");
            }
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
