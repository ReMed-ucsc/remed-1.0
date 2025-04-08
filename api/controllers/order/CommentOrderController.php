<?php

require_once BASE_PATH . '/app/models/OrderComment.php';
require_once BASE_PATH . '/app/models/Patient.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class CommentOrderController
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
                $input = file_get_contents('php://input');
                $data = json_decode($input, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    $result->setErrorStatus(true);
                    $result->setMessage("Invalid JSON input: " . json_last_error_msg());
                    $response['result']['error'] = $result->isError();
                    $response['result']['message'] = $result->getMessage();
                    echo json_encode($response);
                    return;
                }

                // Validate required fields
                if (isset($data['OrderID'], $data['comments'], $data['sender'])) {
                    $orderID = $data['OrderID'];
                    $comment = $data['comments'];
                    $senderType = $data['sender'];

                    $orderCommentModel = new OrderComment();
                    $orderCommentModel->addComment($orderID, $comment, $senderType);

                    $result->setErrorStatus(false);
                    $result->setMessage("Comment added successfully.");
                    $response['result']['error'] = $result->isError();
                    $response['result']['message'] = $result->getMessage();
                    $response['data'] = ['orderID' => $orderID];
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
