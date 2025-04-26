<?php

require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';
require_once BASE_PATH . '/app/models/Driver.php';

class UpdateProfileController
{
    public function index()
    {
        $response = [];
        $result = new Result();

        $input = file_get_contents("php://input");
        $data = json_decode($input, true);
        if (
            empty($data['auth_token']) ||
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
                $name = $data['name'];
                $vehicleNumber = $data['vehicleNumber'];
                $phoneNumber = $data['phoneNumber'];
                $driverId = $data['driverId'];

                if (
                    empty($name) ||
                    empty($vehicleNumber) ||
                    empty($phoneNumber)
                ) {
                    http_response_code(405);
                    $result->setErrorStatus(true);
                    $result->setMessage("Data fields are empty");
                } else {
                    $userData =  $driverModel->updateProfile($driverId, $name, $vehicleNumber, $phoneNumber);

                    http_response_code(200);
                    $result->setErrorStatus(false);
                    $result->setMessage("User profile updated successfully");
                }
            }
        }
        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();

        echo json_encode($response);
    }
}
