<?php

require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class LoginController
{
    public function index()
    {
        $response = [];
        $result = new Result();

        // Get data sent via POST and decode JSON
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (!empty($data['email']) && !empty($data['password'])) {
            $email = $data['email'];
            $password = $data['password'];
            $fcmToken = $data['fcmToken'];

            $userModel = new Driver();
            $user = $userModel->getDriverByEmail($email);

            if ($user) {
                if ($user->status == 'active') {
                    //show($user);
                    // Access password as an object property
                    if (password_verify($password, $user->password)) {
                        $authToken = hash('sha384', microtime() . uniqid() . bin2hex(random_bytes(10)));
                        $userModel->updateToken($email, $authToken);
                        $userModel->updateFcmToken($email, $fcmToken);

                        $response['user']['name'] = $user->driverName;
                        $response['user']['email'] = $email;
                        $response['user']['auth_token'] = $authToken;
                        $response['user']['driverId'] = $user->driverId;

                        $result->setErrorStatus(false);
                        $result->setMessage("Login successful");
                    } else {
                        http_response_code(401);
                        $result->setErrorStatus(true);
                        $result->setMessage("Invalid credentials");
                    }
                } else {
                    http_response_code(401);
                    $result->setErrorStatus(true);
                    $result->setMessage("Sorry your account not activated yet");
                }
            } else {
                http_response_code(404);
                $result->setErrorStatus(true);
                $result->setMessage("User not found");
            }
        } else {
            http_response_code(400);
            $result->setErrorStatus(true);
            $result->setMessage("Email and password are required");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
