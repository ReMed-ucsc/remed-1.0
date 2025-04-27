<?php

require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';
require_once BASE_PATH . '/app/models/Delivery.php';
require_once BASE_PATH . '/app/models/Order.php';
require_once BASE_PATH . '/app/models/MedicineOrder.php';
require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/models/Notification.php';

class ConfirmDeliveryController
{
    public function index()
    {
        $response = [];
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
                http_response_code(400);
                $result->setErrorStatus(true);
                $result->setMessage("Invalid token");
            } else {
                $delivery = new Delivery();
                $order = new Order();
                $orderId = $data['orderId'];
                $deliveryId = $data['deliveryId'];
                $orderResult = $order->getMedicineOrder($orderId);
                if (!$orderResult) {
                    http_response_code(404);
                    $result->setErrorStatus(true);
                    $result->setMessage("No order found");
                } else {
                    $deliveryResult = $delivery->getDeliveryInfo($deliveryId);
                    if (!$deliveryResult) {
                        http_response_code(404);
                        $result->setErrorStatus(true);
                        $result->setMessage("No delivery found");
                    } else {
                        try {
                            $orderDetails = $order->getMedicineOrder($orderId);
                            $orderStatus = $orderDetails->status;

                            //echo json_encode($orderDetails);

                            if ($orderStatus == 'DC') {
                                http_response_code(400);
                                $result->setErrorStatus(true);
                                $result->setMessage("Order already confirmed");
                            } else {
                                if ($orderStatus != 'DP') {
                                    http_response_code(400);
                                    $result->setErrorStatus(true);
                                    $result->setMessage("Package not picked up");
                                } else {
                                    $delivery->changeDeliveryStatus($deliveryId, "Delivered");
                                    $delivery->setDistance($deliveryId, $data['totalDistance']);
                                    $result->setErrorStatus(false);
                                    $result->setMessage("Updated successfully");

                                    $medicineOrderModel = new MedicineOrder();
                                    $medicineOrderModel->updateOrderStatus($orderId, 'DC');

                                    $notificationModel = new Notification();
                                    $notificationModel->createNotification($orderResult->PharmacyID, $orderId, "Order # $orderId delivered");
                                }
                            }
                        } catch (Exception $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    }
                }
            }
        }
        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();

        echo json_encode($response);
    }
}
