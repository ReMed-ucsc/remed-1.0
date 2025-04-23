<?php

class NotificationController
{
    use Controller;

    public function stream($userId){
        
    $notificationModel = new Notification();
    $lastHeartbeat = time();

    // Disable output buffering
    while (ob_get_level()) ob_end_flush();
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('Connection: keep-alive');

    echo ": connected\n\n";
    flush();

    while (true) {
        if (connection_aborted()) {
            exit;
        }

        // Send heartbeat every 15s
        if (time() - $lastHeartbeat > 15) {
            echo ": heartbeat at " . date('H:i:s') . "\n\n";
            flush();
            $lastHeartbeat = time();
        }

        // Check for notifications
        $notifications = $notificationModel->getUnreadNotification($userId);
        if (!empty($notifications)) {
            if (!is_array($notifications)) {
                $notifications = [$notifications];
            }

            foreach ($notifications as $notification) {
                echo "event: notification\n";
                echo "data: " . json_encode([
                    'id' => $notification->notificationId,
                    'message' => $notification->message
                ]) . "\n\n";
            }

            // Mark as read
            $ids = array_map(fn($n) => $n->notificationId, $notifications);
            $notificationModel->markAsRead($ids);

            flush();
        }

        usleep(100000); // 100ms delay
    }
}
}
