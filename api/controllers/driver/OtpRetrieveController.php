<?php

require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class OtpRetrieveController
{
    public function index()
    {
        $response = [];
        $result = new Result();

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (!$data['email'] || !$data['otp']) {
            $result->setErrorStatus(true);
            $result->setMessage("Email and OTP are required");
        } else {
            $email = $data['email'];
            $otp = $data['otp'];

            $userModel = new Driver();

            $user = $userModel->getDriverByEmail($email);

            if (!$user) {
                http_response_code(400);
                $result->setErrorStatus(true);
                $result->setMessage("User not found");
            } else {
                $userOtp = $user->otp;
                $userOtpTime = $user->otpExpireTime;
                $currentTime = time();

                $result->setErrorStatus(false);
                $result->setMessage("OTP retrieved successfully");

                if ($currentTime > strtotime($userOtpTime)) {
                    http_response_code(400);
                    $result->setErrorStatus(true);
                    $result->setMessage("OTP Expired");
                } else {
                    if ($otp != $userOtp) {
                        http_response_code(400);
                        $result->setErrorStatus(true);
                        $result->setMessage("Invalid OTP");
                    } else {
                        http_response_code(200);
                        $result->setErrorStatus(false);
                        $result->setMessage("OTP matched successfully");
                    }
                }
            }
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();

        //show($data);

        echo json_encode($response);
    }
}
