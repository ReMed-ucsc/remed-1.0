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

        try {
            // Fetch and validate authentication headers
            $headers = getallheaders();
            $authHeader = $headers['Auth'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? '';

            if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                throw new Exception("Invalid Authorization header format");
            }

            $authToken = $matches[1];

            // Authenticate patient
            $patientModel = new Patient();
            $patient = $patientModel->first(['token' => $authToken]);

            if (!$patient) {
                throw new Exception("Invalid auth token");
            }

            // Log incoming data for debugging
            file_put_contents('php://stderr', "POST Data: " . print_r($_POST, true));
            file_put_contents('php://stderr', "FILES Data: " . print_r($_FILES, true));

            // Process order data
            $data = null;

            // Handle both direct JSON and form-encoded data
            if (isset($_POST['order'])) {
                // If using multipart/form-data with a JSON string
                $data = json_decode($_POST['order'], true);
            } else {
                // If using direct JSON in request body
                $inputJSON = file_get_contents('php://input');
                $data = json_decode($inputJSON, true);
            }

            $data = $data['order'] ?? $data;
            // show($data);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON input: " . json_last_error_msg());
            }

            // Validate required fields
            if (!isset($data['productIDs'], $data['quantities'], $data['pharmacyID'])) {
                throw new Exception("Missing required fields: productIDs, quantities, or pharmacyID " . $data);
            }

            $productIDs = $data['productIDs'];
            $quantities = $data['quantities'];
            $pickup = $data['pickup'];
            $destination = isset($data['destination']) ? $data['destination'] : 'Pickup';
            $destinationLat = isset($data['destinationLat']) ? $data['destinationLat'] : null;
            $destinationLong = isset($data['destinationLng']) ? $data['destinationLng'] : null;
            $comments = isset($data['comments']) ? $data['comments'] : null;
            $pharmacyID = $data['pharmacyID'];
            $prescriptionPath = '';

            // Validate matching product IDs and quantities
            if (count($productIDs) !== count($quantities)) {
                throw new Exception("Mismatch between product IDs and quantities");
            }

            // Handle prescription file upload if provided
            if (isset($_FILES['prescription']) && $_FILES['prescription']['error'] === UPLOAD_ERR_OK) {
                $prescriptionPath = $this->processPrescriptionFile($patient, $_FILES['prescription']);
            }

            // Create order
            $orderModel = new MedicineOrder();
            $orderListModel = new OrderList();
            $orderCommentModel = new OrderComment();

            $orderID = $orderModel->placeOrder($patient->PatientID, $pickup, $destination, $destinationLat, $destinationLong, $pharmacyID, $prescriptionPath);

            if (!$orderID) {
                throw new Exception("Failed to create order");
            }

            // Set order items
            $success = $orderListModel->setOrderList($orderID, $productIDs, $quantities);

            if (!$success) {
                throw new Exception("Failed to add order items.");
            }

            $success = $orderCommentModel->addComment($orderID,  $comments, 'u');
            if (!$success) {
                throw new Exception("Failed to add order comment. ");
            }

            // Return success response
            $result->setErrorStatus(false);
            $result->setMessage("Order created successfully");
            $response['data'] = ['orderID' => $orderID];
        } catch (Exception $e) {
            $result->setErrorStatus(true);
            $result->setMessage($e->getMessage());
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();

        echo json_encode($response);
    }

    /**
     * Process and validate prescription file upload
     * 
     * @param object $patient Patient object
     * @param array $file File upload data
     * @return string Path to the saved file
     * @throws Exception If file validation or upload fails
     */
    private function processPrescriptionFile($patient, $file)
    {
        $targetDir = BASE_PATH . '/uploads/prescriptions/';

        // Ensure directory exists
        // if (!file_exists($targetDir)) {
        //     mkdir($targetDir, 0755, true);
        // }

        $fileName = $patient->PatientID . '_' . time() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $targetFile = $targetDir . $fileName;

        // Validate file type
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];

        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Invalid file type. Only JPG, JPEG, PNG, and PDF files are allowed.");
        }

        // Validate file size (5MB limit)
        if ($file['size'] > 5000000) {
            throw new Exception("File size exceeds the limit of 5MB.");
        }

        // Move uploaded file
        if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
            throw new Exception("Failed to upload file.");
        }

        return $fileName;
    }
}
