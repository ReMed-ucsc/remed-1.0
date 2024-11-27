<?php

require_once BASE_PATH . '/app/models/DeliveryView.php';
require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';
require_once BASE_PATH . '/api/controllers/utilis/DeliveryUtility.php';
require_once BASE_PATH . '/app/models/DeliveryView.php';

class SendDeliveryController
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
        }

        $orderId = $data['orderId'];

        $utilityModel = new DeliveryUility();

        $deliveryData = $utilityModel->sendDetailstoDriver($orderId);

        // $orderId = $data['orderId'];

        // $orderModel = new OrderView();

        // $columns = ['orderview.destination', 'pharmacy.address'];
        // $data = ['OrderID' => $orderId];

        // $orderModel->setLimit(1);

        // $result = $orderModel->join(
        //     'pharmacy',
        //     'orderview.PharmacyID = pharmacy.PharmacyID',
        //     $data,
        //     [],
        //     $columns
        // );

        // // Check if the result exists and return a valid response
        // if ($result) {
        //     // Return the result as a JSON response
        //     echo json_encode($result);
        // } else {
        //     // If no data found, return an error response
        //     echo json_encode(['error' => 'Data not found']);
        // }
    }
}
