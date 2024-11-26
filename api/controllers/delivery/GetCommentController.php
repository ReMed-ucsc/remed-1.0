<?php
require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';
class GetCommentsController
{
    public function index()
    {
        $response = array();
        $result = new Result();
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $_SERVER['HTTP_AUTH'] ?? '';
        if(preg_match('/Bearer\s(\S+)/', $authHeader, $matches)){
            $authToken = $matches[1];
            $driverModel = new Driver();
            $driver = $driverModel->first(['token' => $authToken]);
            if($driver){
                $commentList = $driverModel->getComments();
            }
        }
    }
}