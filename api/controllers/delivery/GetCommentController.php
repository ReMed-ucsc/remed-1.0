<?php

require_once BASE_PATH . '/app/models/DeliveryComment.php';
require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class GetCommentsController
{
    use Model;

    public function index()
    {
        $response = array();
        $result = new Result();

        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $_SERVER['HTTP_AUTH'] ?? '';

        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $authToken = $matches[1];

            $commentModel = new DeliveryCommentView();
            $driverModel = new Driver();
            $driver = $driverModel->first(['token' => $authToken]);

            if ($driver) {
                $commentList = $commentModel->getComments($driver);
                $response['result'] = $commentList;
            } else {
                $result->setErrorStatus(true);
                $result->setMessage("Invalid comment ID");
            }
            $response['result']['error'] = $result->isError();
            $response['result']['message'] = $result->getMessage();
            echo json_encode($response);
        }
    }
}
