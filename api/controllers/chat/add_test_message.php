<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'pharmacy_chat');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Test data
$sender_id = 1; // Pharmacy ID
$receiver_id = 2; // Patient ID
$message = "This is a test message!";

// Insert message into the database
$stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message, sent_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iis", $sender_id, $receiver_id, $message);

if ($stmt->execute()) {
    echo "Message added successfully!";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
