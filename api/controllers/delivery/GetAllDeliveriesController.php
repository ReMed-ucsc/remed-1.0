<?php

require_once BASE_PATH . '/app/models/Delivery.php';
require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class GetAllDeliveriesController
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

        $driverId = $data['driverId'];

        $deliveryModel = new Delivery();

        $delivery = $deliveryModel->getAllDeliveriesOfADriver($driverId);

        if (!$delivery) {
            $response['error'] = true;
            $response['message'] = 'No delivery found';
        } else {
            $response['alldeliveryInfo']['data'] = $delivery;
        }

        $response['alldeliveryInfo']['error'] = $result->isError();
        $response['alldeliveryInfo']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
