<?php

require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/helper_classes.php';
require_once BASE_PATH . '/api/controllers/utilis/MailUtility.php';

class ForgetPasswordController
{
    public function index()
    {
        $response = [];
        $result = new Result();
        $mailUtility = new MailUtility();

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        //print_r($data);

        if (
            !empty($data['email'])
        ) {
            try {
                $email = $data['email'];

                $userModel = new Driver();
                $user = $userModel->getDriverByEmail($email);

                if (!$user) {
                    http_response_code(400);
                    $result->setErrorStatus(true);
                    $result->setMessage("User not found");
                } else {
                    $otp = rand(100000, 999999);
                    $expiery = date('Y-m-d H:i:s', strtotime('+30 minutes'));

                    $driverId = $user->driverId;

                    //echo json_encode($user);

                    $msg = $mailUtility->sendMail($email, $otp);

                    $userModel->otpAdd($driverId, $otp, $expiery);

                    $result->setErrorStatus(false);
                    $result->setMessage("Otp sent successfully");
                }
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                $result->setErrorStatus(true);
                $result->setMessage("Internal server error");
            }
        } else {
            http_response_code(400);
            $result->setErrorStatus(true);
            $result->setMessage("Name and email are required");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
