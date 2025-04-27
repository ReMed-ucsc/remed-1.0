<?php

class Notification
{
    use Model;

    protected $table = 'notifications';
    protected $allowedColumns = ['notificationId', 'orderId', 'pharmacyId', 'notification', 'isRead', 'message'];
    protected $orderColumn = "notificationId";

    public function getUnreadNotification($userId)
    {
        $condition = [
            'pharmacyId' => $userId,
            'isRead' => 0
        ];
        return $this->selectWhere(conditions: $condition);
    }

    public function markAsRead($ids)
    {
        if (empty($ids)) return;

        $placeholders = [];
        $data = [];

        foreach ($ids as $index => $id) {
            $key = ":id$index";
            $placeholders[] = $key;
            $data[$key] = $id;
        }

        $inClause = implode(', ', $placeholders);
        $query = "UPDATE notifications SET isRead = 1 WHERE notificationId in ($inClause)";

        return $this->query($query, $data);
    }

    public function createNotification($pharmacyId, $orderId, $message)
    {
        $data = [
            "pharmacyId" => $pharmacyId,
            "orderId" => $orderId,
            "message" => $message,
            'isRead' => 0
        ];
        return $this->insert($data);
    }

    public function getAllNotifications($userId)
    {
        $condition = [
            'pharmacyId' => $userId,
        ];
        return $this->selectWhere(conditions: $condition);
    }
}
