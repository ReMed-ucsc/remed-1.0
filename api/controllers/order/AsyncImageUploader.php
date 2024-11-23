<?php

require_once BASE_PATH . '/app/models/MedicineOrder.php';
require_once BASE_PATH . '/app/models/OrderList.php';
require_once BASE_PATH . '/app/models/Patient.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class CreateOrderController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        // Fetch headers
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $_SERVER['HTTP_AUTH'] ?? '';

        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $authToken = $matches[1];

            $patientModel = new Patient();
            $patient = $patientModel->first(['token' => $authToken]);

            if ($patient) {
                // Decode JSON input
                // $data = json_decode(file_get_contents('php://input'), true);
                // Log the raw input for debugging
                file_put_contents('php://stderr', print_r($_POST, true));

                // Assuming you have received the multipart data
                $orderJson = $_POST['order']; // This is the JSON string part
                // $prescriptionFile = $_FILES['prescription']; // This is the file part

                // Convert the JSON string back to an associative array
                $data = json_decode($orderJson, true);
                // show($_POST);
                // show($data);
                // show(isset($_FILES['prescription']) ? 'ys' : 'No file');

                if (json_last_error() !== JSON_ERROR_NONE) {
                    $result->setErrorStatus(true);
                    $result->setMessage("Invalid JSON input : " . json_last_error());
                    $response['result']['error'] = $result->isError();
                    $response['result']['message'] = $result->getMessage();
                    echo json_encode($response);
                    return;
                }

                // Validate required fields
                if (isset($data['productIDs'], $data['quantities'], $data['pharmacyID'])) {
                    $productIDs = $data['productIDs'];
                    $quantities = $data['quantities'];
                    $pickup = isset($data['pickup']) ? 1 : 0;
                    $destination = isset($data['destination']) ? $data['destination'] : 'Pickup';
                    $pharmacyID = $data['pharmacyID'];
                    $targetFile = '';

                    // Validate productIDs and quantities
                    if (count($productIDs) === count($quantities)) {
                        $orderModel = new MedicineOrder();
                        $orderListModel = new OrderList();

                        // Handle file upload
                        if (isset($_FILES['prescription']) && $_FILES['prescription']['error'] === UPLOAD_ERR_OK) {
                            $targetDir = BASE_PATH . '/uploads/prescriptions/';
                            $fileName = $patient->PatientID . '_' . time() . '.' . pathinfo($_FILES['prescription']['name'], PATHINFO_EXTENSION);
                            $targetFile = $targetDir . $fileName;

                            // Include file information in the response for debugging
                            // $fileInfo = [
                            //     'name' => $_FILES['prescription']['name'],
                            //     'type' => $_FILES['prescription']['type'],
                            //     'size' => $_FILES['prescription']['size'],
                            //     'tmp_name' => $_FILES['prescription']['tmp_name'],
                            //     'error' => $_FILES['prescription']['error']
                            // ];

                            // Validate file type and size
                            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                            $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];
                            if (!in_array($fileType, $allowedTypes)) {
                                $result->setErrorStatus(true);
                                $result->setMessage("Invalid file type. Only JPG, JPEG, PNG, and PDF files are allowed.");
                                $response['result']['error'] = $result->isError();
                                $response['result']['message'] = $result->getMessage();
                                // $response['file_info'] = $fileInfo; // Add file info to the response
                                echo json_encode($response);
                                return;
                            }

                            if ($_FILES['prescription']['size'] > 5000000) { // 5MB limit
                                $result->setErrorStatus(true);
                                $result->setMessage("File size exceeds the limit of 5MB.");
                                $response['result']['error'] = $result->isError();
                                $response['result']['message'] = $result->getMessage();
                                // $response['file_info'] = $fileInfo; // Add file info to the response
                                echo json_encode($response);
                                return;
                            }

                            if (!move_uploaded_file($_FILES['prescription']['tmp_name'], $targetFile)) {
                                $result->setErrorStatus(true);
                                $result->setMessage("Failed to upload file.");
                                $response['result']['error'] = $result->isError();
                                $response['result']['message'] = $result->getMessage();
                                // $response['file_info'] = $fileInfo; // Add file info to the response
                                echo json_encode($response);
                                return;
                            }

                            // Add success response
                            $result->setErrorStatus(false);
                            $result->setMessage("File uploaded successfully.");
                            $response['result']['error'] = $result->isError();
                            $response['result']['message'] = $result->getMessage();
                            echo json_encode($response);
                        } else {
                            $result->setErrorStatus(true);
                            $result->setMessage("Prescription file is required.");
                            $response['result']['error'] = $result->isError();
                            $response['result']['message'] = $result->getMessage();
                            echo json_encode($response);
                        }

                        // Create order
                        $orderID = $orderModel->placeOrder($patient->PatientID, $pickup, $destination, $pharmacyID, $targetFile);

                        if ($orderID) {
                            // Set order items
                            $orderListModel->setOrderList($orderID, $productIDs, $quantities);

                            $result->setErrorStatus(false);
                            $result->setMessage("Order created successfully");
                            $response['data'] = ['orderID' => $orderID];
                        } else {
                            $result->setErrorStatus(true);
                            $result->setMessage("Failed to create order. Retuned order ID : " . $orderID);
                        }
                    } else {
                        $result->setErrorStatus(true);
                        $result->setMessage("Mismatch between product IDs and quantities");
                    }
                } else {
                    $result->setErrorStatus(true);
                    $result->setMessage("Missing required fields");
                }
            } else {
                $result->setErrorStatus(true);
                $result->setMessage("Invalid auth token");
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("Invalid Authorization header format");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
