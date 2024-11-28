<?php

require_once BASE_PATH . '/app/models/DeliveryCommentView.php';
require_once BASE_PATH . '/app/models/Delivery.php';
require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class GetCommentController
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

        $commentModel = new DeliveryCommentView();
        $deliveryModel = new Delivery();
        //$driverModel = new Driver();

        $driverId = $data['DeliveryID'];

        if ($driverId) {

            $data = ['DeliveryID' => $driverId];

            try {
                $res = $deliveryModel->first($data);

                // echo json_encode($res);
                // echo json_encode(['driverId' => $res['driverId']]);

                //$response['data'] = $res;

                if ($res['driverId'] != null) {
                    $commentList = $commentModel->getComments($driverId);
                    $response['data'] = $commentList;
                } else {
                    $result->setErrorStatus(true);
                    $result->setMessage("Invalid DeliveryID");
                }
            } catch (Exception $e) {
                $result->setErrorStatus(true);
                $result->setMessage("error happend " . $e->getMessage());
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("no driverId found");
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
