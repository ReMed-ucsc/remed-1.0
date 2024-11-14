<?php

require_once BASE_PATH . '/app/models/User.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class LoginController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        // get data sent using post method and store
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (!empty($data['email']) && !empty($data['password'])) {
            $email = $data['email'];
            $password = $data['password'];

            $userModel = new Patient();
            $user = $userModel->getPatientByEmail($email);

            if ($user) {
                if (password_verify($password, $user->password)) {
                    $authToken = hash('sha384', microtime() . uniqid() . bin2hex(random_bytes(10)));
                    $userModel->updateToken($email, $authToken);

                    $response['user']['name'] = $user->patientName;
                    $response['user']['email'] = $email;
                    $response['user']['auth_token'] = $authToken;

                    $result->setErrorStatus(false);
                    $result->setMessage("Login successful");
                } else {
                    $result->setErrorStatus(true);
                    $result->setMessage("Invalid credentials");
                }
            } else {
                $result->setErrorStatus(true);
                $result->setMessage("User not found");
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("Email and password are required");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
