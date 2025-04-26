<?php

require_once BASE_PATH . '/app/models/DeliveryView.php';
require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';
require_once BASE_PATH . '/app/models/Notification.php';
require_once BASE_PATH . '/app/models/MedicineOrder.php';


class GetDeliveryController
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

        $orderId = $data['orderId'];
        $token = $data['auth_token'];
        $driverId = $data['driverId'];

        if (empty($orderId) || empty($token) || empty($driverId)) {
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
                $deliveryModel = new DeliveryView();

                $delivery = $deliveryModel->getDeliveryInfo($orderId, $driverId);

                //echo json_encode($delivery);

                if (!$delivery) {
                    $response['error'] = true;
                    $response['message'] = 'No order found';
                } else {
                    if ($delivery['status'] == 'WP') {

                        $delivery['pharmacyLatitude'] = number_format($delivery['pharmacyLatitude'], 6, '.', '');
                        $delivery['pharmacyLongitude'] = number_format($delivery['pharmacyLongitude'], 6, '.', '');
                        $delivery['destinationLatitude'] = number_format($delivery['destinationLatitude'], 6, '.', '');
                        $delivery['destinationLongitude'] = number_format($delivery['destinationLongitude'], 6, '.', '');

                        $response['data'] = $delivery;
                        $result->setErrorStatus(false);
                        $result->setMessage("Order found");

                        $medicineOrderModel = new MedicineOrder();
                        $medicineOrderModel->updateOrderStatus($delivery['orderId'], 'DP');

                        $notificationModel = new Notification();
                        $notificationModel->createNotification($delivery['pharmacyId'], $delivery['orderId'], "order $orderId accepted for delivery");
                    } else {
                        http_response_code(400);
                        $result->setErrorStatus(true);
                        $response['error'] = true;
                        $response['message'] = 'Order already Confirmed';
                    }
                }
            }
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
