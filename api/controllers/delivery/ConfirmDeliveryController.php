<?php

require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';
require_once BASE_PATH . '/app/models/Delivery.php';
require_once BASE_PATH . '/app/models/Order.php';
require_once BASE_PATH . '/app/models/MedicineOrder.php';
require_once BASE_PATH . '/app/models/Driver.php';

class ConfirmDeliveryController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        $input = file_get_contents("php://input");
        $data = json_decode($input, true);

        if (
            empty($data['orderId']) ||
            empty($data['auth_token']) ||
            empty($data['deliveryId']) ||
            empty($data['driverId'])
        ) {
            http_response_code(400);

            $result->setErrorStatus(true);
            $result->setMessage("All fileds are required");
        } else {
            $driverModel = new Driver();
            $tokenStatus = $driverModel->verifyToken($data['driverId'], $data['auth_token']);

            if (!$tokenStatus) {
                $result->setErrorStatus(true);
                $result->setMessage("Invalid token");
            } else {
                $delivery = new Delivery();
                $order = new Order();

                $orderId = $data['orderId'];
                $deliveryId = $data['deliveryId'];

                $orderResult = $order->getMedicineOrder($orderId);

                if (!$orderResult) {
                    $result->setErrorStatus(true);
                    $result->setMessage("No order found");
                } else {
                    $deliveryResult = $delivery->getDeliveryInfo($deliveryId);

                    if (!$deliveryResult) {
                        $result->setErrorStatus(true);
                        $result->setMessage("No delivery found");
                    } else {
                        $delivery->changeDeliveryStatus($deliveryId, "Delivered");

                        $result->setErrorStatus(false);
                        $result->setMessage("Updated successfully");
                    }
                }
            }
        }

        $response['error'] = $result->isError();
        $response['message'] = $result->getMessage();

        echo json_encode($response);
    }
}
