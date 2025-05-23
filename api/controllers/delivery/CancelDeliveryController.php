<?php

require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';
require_once BASE_PATH . '/app/models/Delivery.php';
require_once BASE_PATH . '/app/models/MedicineOrder.php';
require_once BASE_PATH . '/api/controllers/utilis/DeliveryUtility.php';

class CancelDeliveryController
{
    public function index()
    {
        $result = new Result();
        $respone = [];

        $orderId = "";
        $deliveryId = "";

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (
            empty($data['auth_token']) ||
            empty($data['orderId']) ||
            empty($data['deliveryId']) ||
            empty($data['driverId'])
        ) {
            http_response_code(400);
            $result->setErrorStatus(true);
            $result->setMessage("All the fields are required");
        } else {
            $orderId = $data['orderId'];
            $deliveryId = $data['deliveryId'];
            $token = $data['auth_token'];
            $driverId = $data['driverId'];

            $driverModel = new Driver();
            $tokenStatus = $driverModel->verifyToken($driverId, $token);

            if (!$tokenStatus) {
                http_response_code(400);
                $result->setErrorStatus(true);
                $result->setMessage("Invalid token");
            } else {

                $medicineOrderModel = new MedicineOrder();

                $order = $medicineOrderModel->getOrderDetails($orderId);

                if (empty($order)) {
                    http_response_code(404);
                    $result->setErrorStatus(true);
                    $result->setMessage("No order found");
                } else {
                    $deliveryModel = new Delivery();

                    $delivery = $deliveryModel->getDeliveryInfo($deliveryId);

                    if (empty($delivery)) {
                        http_response_code(404);
                        $result->setErrorStatus(true);
                        $result->setMessage("No delivery found");
                    } else {
                        if ($delivery->status == 'pickedUp') {
                            $deliveryModel->addToBreakDownAfterPickup(
                                $driverId,
                                $deliveryId,
                                $orderId,
                                $data['lat'],
                                $data['lng']
                            );
                        } else {
                            //sending new delivery requests if the package still in the pharmacy
                            $deliveryUtilityModel = new DeliveryUility();
                            $deliveryUtilityModel->sendDetailstoDriver($orderId);
                        }
                        $deliveryModel->changeDeliveryStatus($deliveryId, "Cancel");

                        http_response_code(200);
                        $result->setErrorStatus(false);
                        $result->setMessage("Order canceled");

                        $order = new Order();
                        $orderResult = $order->getMedicineOrder($orderId);

                        $notificationModel = new Notification();
                        $notificationModel->createNotification($orderResult->PharmacyID, $orderId, "Order $orderId Canceled");
                    }
                }
            }
        }

        $respone['result']['error'] = $result->isError();
        $respone['result']['message'] = $result->getMessage();

        echo json_encode($respone);
    }
}
