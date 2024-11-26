<?php

class DeliveryCommentView
{
    use Model;

    protected $table = 'comments';
    protected $allowed = ['CommentID', 'OrderID', 'DeliveryID', 'DriverID'];

    public function getComments($driverID)
    {
        $data = ['DriverID' => $driverID];
        $this->setLimit(null);
        $this->setOffset(null);

        return $this->where($data, []);
    }

    public function updateComments($commentID, $comment)
    {
        if (!is_numeric($commentID)) {
            $this->errors['error'] = 'Invalid Comment ID';
            return false;
        }

        $data = [
            'comment' => $comment
        ];

        return $this->update($commentID, $data, 'CommentID');
    }

    public function createComment($DriverID, $DeliveryID, $comment)
    {
        $data = [
            'DeliverID' => $DeliveryID,
            'DriverID' => $DriverID,
            'comment' => $comment
        ];

        return $this->insert($data);
    }

    public function deleteComment($commentID) {}
}
