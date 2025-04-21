<?php

require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';
require_once BASE_PATH . '/app/models/Driver.php';

class ResetPasswordController
{
    public function index()
    {
        $response = [];
        $result = new Result();

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        //show($data);

        if (empty($data['password']) || empty($data['email']) || empty($data['otp'])) {
            http_response_code(400);
            $result->setErrorStatus(true);
            $result->setMessage("Email, Password and otp are required");
        } else {
            $email = $data['email'];
            $password = $data['password'];

            $userModel = new Driver();
            $user = $userModel->getDriverByEmail($email);

            if (!$user) {
                http_response_code(400);
                $result->setErrorStatus(true);
                $result->setMessage("User not found");
            } else {
                $userId = $user->driverId;
                $userModel->resetPassword($userId, $password);

                $result->setErrorStatus(false);
                $result->setMessage("Password reset successfully");
            }
        }
        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();

        echo json_encode($response);
    }
}
