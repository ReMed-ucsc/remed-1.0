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
            !empty($data['rePassword']) &&
            !empty($data['dob']) &&
            !empty($data['NIC']) &&
            !empty($data['telNo']) &&
            !empty($data['vehicalLicenseNumber']) &&
            !empty($data['deliveryTime'])
        ) {
            try {
                $name = $data['name'];
                $email = $data['email'];
                $password = $data['password'];
                $confirmPassword = $data['rePassword'];
                $dob = $data['dob'];
                $telNo = $data['telNo'];
                $NIC = $data['NIC'];
                $deliveryTime = $data['deliveryTime'];
                $vehicleNumber = $data['vehicalLicenseNumber'];

                $userModel = new Driver();
                $user = $userModel->getDriverByEmail($email);

                if (!$user) {
                    if (
                        strlen($password) < 8 ||
                        !preg_match('/\d/', $password) ||
                        !preg_match('/[!@#$%^&*]/', $password) ||
                        !preg_match('/[A-Z]/', $password) ||  // Check for uppercase
                        !preg_match('/[a-z]/', $password)
                    ) {
                        http_response_code(400);
                        $result->setErrorStatus(true);
                        $result->setMessage("Password doesn't fill criteria");
                    } else {
                        if ($password !== $confirmPassword) {
                            http_response_code(400);
                            $result->setErrorStatus(true);
                            $result->setMessage("Password doesn't match");
                        } else {
                            if ($userModel->registerDriver($name, $email, $password, $dob, $telNo, $NIC, $deliveryTime, $vehicleNumber)) {
                                $result->setErrorStatus(false);
                                $result->setMessage("Registration successful");
                            } else {
                                http_response_code(500);
                                $result->setErrorStatus(true);
                                $result->setMessage("Registration unsuccessful");
                            }
                        }
                    }
                } else {
                    http_response_code(409); //Conflict
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
            http_response_code(400);
            $result->setErrorStatus(true);
            $result->setMessage("All fields are required");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
