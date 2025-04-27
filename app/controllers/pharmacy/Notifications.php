<?php

class Notifications
{
    use Controller;
    public function index()
    {
        // Check if user is logged in and get pharmacyId
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
        }

        $userId = $_SESSION['user_id'];
        $notificationModel = new Notification();

        // Get all notifications for the pharmacy (both read and unread)
        $notifications = $notificationModel->getAllNotifications($userId);

        // Get unread notification count for display
        //$unreadCount = $notificationModel->getUnreadCount($userId);

        $data = [
            'notifications' => $notifications,
        ];

        // Load notification view with data
        $this->view('pharmacy/notifications', $data);
    }

    // add other methods like edit, update, delete, etc.
}
