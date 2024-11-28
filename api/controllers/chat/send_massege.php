<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'] ?? '';
    $file = $_FILES['file'] ?? null;

    // Save the message to the database
    if ($message) {
        // Insert the message into the database
    }

    // Save the file to the server
    if ($file) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            // Save the file URL to the database if needed
        }
    }

    echo json_encode(['success' => true]);
}
?>
