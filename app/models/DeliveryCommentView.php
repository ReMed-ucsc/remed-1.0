<?php

class DeliveryCommentView
{
    use Model;

    protected $table = 'comment';
    protected $allowed = ['CommentID', 'OrderID', 'DeliveryID', 'driverId'];

    public function getComments($deliveryID)
    {
        $data = ['DeliveryID' => $deliveryID];
        $this->setLimit(null);
        $this->setOffset(null);

        return $this->where($data);
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
            'DeliveryID' => $DeliveryID,
            'DriverID' => $DriverID,
            'comment' => $comment
        ];

        return $this->insert($data);
    }

    public function deleteComment($commentID)
    {
        return $this->delete($commentID, 'CommentID');
    }

    public function getOneComment($commentID)
    {
        $query = "SELECT * FROM comment WHERE CommentID = :CommentID";
        $data = [
            'CommentID' => $commentID
        ];

        return $this->query($query, $data);
    }
}
