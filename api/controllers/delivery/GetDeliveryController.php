<?php

require_once BASE_PATH . '/app/models/DeliveryView.php';
require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

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

        $deliveryModel = new DeliveryView();

        $delivery = $deliveryModel->getDeliveryInfo($orderId);

        if (!$delivery) {
            $response['error'] = true;
            $response['message'] = 'No order found';
        } else {
            $response['data'] = $delivery;
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }

    // public function index()
    // {
    //     echo json_encode("get comment controller");
    // }
}
