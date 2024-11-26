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

        if(!empty($data['name']) && !empty($data['email']) && !empty($data['password'])){
            $name = $data['name'];
            $email = $data['email'];
            $password = $data['password'];

            $userModel = new User;
            $user = $userModel->getUserByEmail($email);

            if(!$user){
                $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
                if($userModel->registerUser($name, $email, $password)){
                    $result->setErrorStatus(false);
                    $result->setMessage("Registration succesfull");
                }else{
                    $result->setErrorStatus(true);
                    $result->setMessage("Error happend");
                }
            }else{
                $result->setErrorStatus(true);
                $result->setMessage("User Already exist");
            }
        }else{
            $result->setErrorStatus(true);
            $result->setMessage("All the fields are required");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}