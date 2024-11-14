<?php

require_once BASE_PATH . '/app/models/User.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class RegisterController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (!empty($data['name']) && !empty($data['email']) && !empty($data['password'])) {
            $name = $data['name'];
            $email = $data['email'];
            $password = $data['password'];

            $userModel = new User();
            $user = $userModel->getUserByEmail($email);

            if (!$user) {
                $passEnc = password_hash($password, PASSWORD_DEFAULT);
                if ($userModel->registerUser($name, $email, $passEnc)) {
                    $result->setErrorStatus(false);
                    $result->setMessage("Registered successfully, please login");
                } else {
                    $result->setErrorStatus(true);
                    $result->setMessage("Something went wrong. Please retry");
                }
            } else {
                $result->setErrorStatus(true);
                $result->setMessage("You are already registered, please login");
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("Name, email, and password are required");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
