<?php

require_once BASE_PATH . '/app/models/DeliveryCommentView.php';
require_once BASE_PATH . '/app/models/Delivery.php';
require_once BASE_PATH . '/app/models/Driver.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class CreateCommentController
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

        if (empty($data['deliveryId']) || empty($data['comment'])) {
            $result->setErrorStatus(true);
            $result->setMessage("All the fields are required");
        } else {

            $deliveryId = $data['deliveryId'];
            $comment = $data['comment'];

            if (!empty($comment)) {
                $patterns = [
                    '/<script\b[^>]*>(.*?)<\/script>/is', // script tags
                    '/on\w+="[^"]*"/i',  //inline event handling
                    '/javascript:/i',
                    '/<iframe\b[^>]*>/i', //ifram tags
                    '/<img\b[^>]*on\w+=["\'][^"\']*["\']/i', //img with error tags
                    '/<svg\b[^>]*>/i'
                ];

                foreach ($patterns as $pattern) {
                    if (preg_match($pattern, $comment)) {
                        http_response_code(400);
                        $result->setErrorStatus(true);
                        $result->setMessage("text contain unwantted elemtns");

                        $response['result']['error'] = $result->isError();
                        $response['result']['message'] = $result->getMessage();
                        echo json_encode($response);

                        return;
                    }
                }
            }

            $deliveryData = $deliveryModel->first(["DeliveryId" => $deliveryId]);

            if ($deliveryData) {

                $data = ['DeliveryID' => $deliveryId];

                try {
                    $res = $deliveryModel->first($data);

                    $driverId = $res->driverId;

                    //echo json_encode($res);
                    // echo json_encode(['deliveryId' => $res['DeliveryID']]);

                    //$response['data'] = $res;

                    if ($res->driverId != null && $res->DeliveryID != null) {

                        $data = [
                            "comment" => $comment
                        ];

                        $commentModel->createComment($driverId, $deliveryId, $comment);

                        $result->setErrorStatus(false);
                        $result->setMessage("success");
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
                $result->setMessage("no Delivery found");
            }
        }
        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
