<?php

class OrderComment
{
    use Model;

    protected $table = 'ordercomments';
    protected $allowedColumns = ['OrderID', 'comments', 'sender', 'createdAt'];
    protected $order_column = "commentID";

    public function addComment($orderID, $comment, $senderType)
    {
        $data = [
            'OrderID' => $orderID,
            'comments' => $comment,
            'sender' => $senderType,
            'createdAt' => date('Y-m-d H:i:s')
        ];

        return $this->insert($data);
    }

    public function getCommentsByOrder($orderID)
    {
        return $this->where(['OrderID' => $orderID]);
    }
}
