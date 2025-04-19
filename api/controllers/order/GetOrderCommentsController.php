<?php

require_once BASE_PATH . '/app/models/OrderComment.php';
require_once BASE_PATH . '/app/models/Patient.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class GetOrderCommentsController
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
                if (isset($data['OrderID'])) {
                    $orderID = $data['OrderID'];

                    $orderCommentModel = new OrderComment();
                    $comments = $orderCommentModel->getCommentsByOrder($orderID);

                    if ($comments) {
                        // Map sender types
                        $senderMap = [
                            'u' => 'user',
                            'p' => 'pharmacy',
                            'd' => 'driver'
                        ];

                        foreach ($comments as &$comment) {
                            $comment->sender = $senderMap[$comment->sender] ?? 'unknown';
                        }

                        $result->setErrorStatus(false);
                        $result->setMessage("Comments retrieved successfully.");
                        $response['data'] = $comments;
                    } else {
                        $result->setErrorStatus(true);
                        $result->setMessage("No comments found for this order");
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
