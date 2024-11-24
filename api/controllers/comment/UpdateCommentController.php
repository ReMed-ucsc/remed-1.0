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
        $response = array();
        $result = new Result();

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON input']);
            return;
        } else {
            //echo json_encode($data);
        }

        $commentModel = new DeliveryCommentView();
        $deliveryModel = new Delivery();
        //$driverModel = new Driver();

        $commentId = $data['CommentID'];
        $comment = $data['Comment'];

        if ($commentId) {

            $data = ['CommentID' => $commentId];

            try {
                $res = $commentModel->first($data);

                //echo json_encode($res);
                //echo json_encode(['CommentID' => $res['CommentID']]);

                //$response['data'] = $res;

                if ($res['CommentID'] != null) {

                    $data = [
                        "comment" => $comment
                    ];

                    $commentModel->updateComments($commentId, $comment);

                    $result->setErrorStatus(false);
                    $result->setMessage("");
                } else {
                    $result->setErrorStatus(true);
                    $result->setMessage("Invalid CommentID");
                }
            } catch (Exception $e) {
                $result->setErrorStatus(true);
                $result->setMessage("error happend " . $e->getMessage());
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("no driverId found");
        }
        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }

    // public function index()
    // {
    //     echo json_encode("get comment controller");
    // }
}
