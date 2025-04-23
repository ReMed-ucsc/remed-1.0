<?php
require_once __DIR__ . '/../../../remed-1.0/app/core/init.php';
require_once __DIR__ . '/../../../remed-1.0/app/models/Notification.php';
require_once __DIR__ . '/../../../remed-1.0/app/controllers/pharmacy/NotificationController.php';

// === Session Setup ===
session_start();

// === Session user id for validation (simplified for now) ===
$sessionUserId = $_SESSION['user_id'] ?? null;

// === Release session lock ===
session_write_close();

// === SSE Streaming Headers ===
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');
header('X-Accel-Buffering: no');

// Disable output buffering
while (ob_get_level()) ob_end_clean();
ini_set('output_buffering', 'Off');
ini_set('zlib.output_compression', false);
ignore_user_abort(true);
set_time_limit(0);

// === Stream Notifications ===
$controller = new NotificationController();

// Send heartbeats every 15 seconds
$lastHeartbeat = time();
while (true) {
    if (connection_aborted()) {
        echo "Connection aborted!\n\n";
        exit;
    }

    // Send heartbeat every 15 seconds to keep the connection alive
    if (time() - $lastHeartbeat > 15) {
        echo ": heartbeat\n\n";  // This is a heartbeat message
        ob_flush(); 
        flush(); // Ensure it is sent to the client
        $lastHeartbeat = time();
        echo "Sent heartbeat\n"; // Debugging message
    }

    // Get unread notifications for the user
    $notifications = $controller->stream($sessionUserId);

    // Sleep for a short interval (e.g., 100ms) before the next loop
    usleep(100000); // 100ms
}
