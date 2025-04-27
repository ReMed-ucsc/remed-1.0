<?php

require_once BASE_PATH . '/app/models/DeliveryCommentView.php';
require_once BASE_PATH . '/app/models/Delivery.php';
require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class UpdateCommentController
{
    public function index()
    {
        $response = [];
        $result = new Result();

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON input']);
            return;
        }

        $commentModel = new DeliveryCommentView();

        $commentId = $data['commentId'];

        //$commentId = $requestData['commentId'] ?? null;
        $comment = $data['comment'] ?? '';

        //echo json_encode($requestData);

        if ($commentId) {
            //$queryParams = ['CommentID' => $commentId];

            try {
                $commentList = $commentModel->getOneComment($commentId);
                //$response['data'] = $commentList;

                if (!empty($commentList)) {
                    $commentModel->updateComments($commentId, $comment);

                    $result->setErrorStatus(false);
                    $result->setMessage("Comment updated successfully");
                } else {
                    $result->setErrorStatus(true);
                    $result->setMessage("Invalid CommentID");
                }
            } catch (Exception $e) {
                $result->setErrorStatus(true);
                $result->setMessage("Error occurred: " . $e->getMessage());
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("No CommentID provided");
        }

        $response['result'] = [
            'error' => $result->isError(),
            'message' => $result->getMessage()
        ];

        echo json_encode($response);
    }
}
