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

        if (empty($data['DeliveryID']) || empty($data['DriverID']) || empty($data['Comment'])) {
            $result->setErrorStatus(true);
            $result->setMessage("All the fields are required");
        } else {

            $deliveryId = $data['DeliveryID'];
            $driverId = $data['DriverID'];
            $comment = $data['Comment'];

            if ($deliveryId) {

                $data = ['DeliveryID' => $deliveryId];

                try {
                    $res = $commentModel->first($data);

                    //echo json_encode($res);
                    //echo json_encode(['CommentID' => $res['CommentID']]);

                    //$response['data'] = $res;

                    if ($res['DriverID'] != null && $res['DeliveryID'] != null) {

                        $data = [
                            "comment" => $comment
                        ];

                        $commentModel->createComment($driverId, $deliveryId, $comment);

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
        }
        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}
