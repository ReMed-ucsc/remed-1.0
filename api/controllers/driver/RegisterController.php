<?php

require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class RegisterController
{
    public function index()
    {
        $response = [];
        $result = new Result();

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (
            !empty($data['name']) &&
            !empty($data['email']) &&
            !empty($data['password']) &&
            !empty($data['dob']) &&
            !empty($data['NIC']) &&
            !empty($data['deliveryTime'])
        ) {
            try {
                $name = $data['name'];
                $email = $data['email'];
                $password = $data['password'];
                $dob = $data['dob'];
                $telNo = $data['telNo'];
                $NIC = $data['NIC'];
                $deliveryTime = $data['deliveryTime'];

                $userModel = new Driver();
                $user = $userModel->getDriverByEmail($email);

                if (!$user) {
                    if ($userModel->registerDriver($name, $email, $password, $dob, $telNo, $NIC, $deliveryTime)) {
                        $result->setErrorStatus(false);
                        $result->setMessage("Registration successful");
                    } else {
                        $result->setErrorStatus(true);
                        $result->setMessage("Registration unsuccessful");
                    }
                } else {
                    $result->setErrorStatus(true);
                    $result->setMessage("User already exists");
                }
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                $result->setErrorStatus(true);
                $result->setMessage("Internal server error");
            } catch (Exception $e) {
                error_log("General error: " . $e->getMessage());
                $result->setErrorStatus(true);
                $result->setMessage("Unexpected error");
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("All fields are required");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
