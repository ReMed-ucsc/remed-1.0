
<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'pharmacy_chat');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sender_id = $_GET['sender_id'];   // Pharmacy ID or Patient ID
$receiver_id = $_GET['receiver_id']; // Opposite ID

if ($sender_id && $receiver_id) {
    $stmt = $conn->prepare("
        SELECT m.*, u.name AS sender_name 
        FROM messages m
        JOIN users u ON m.sender_id = u.id
        WHERE (m.sender_id = ? AND m.receiver_id = ?)
        OR (m.sender_id = ? AND m.receiver_id = ?)
        ORDER BY m.sent_at ASC
    ");
    $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $messages = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($messages);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
}
?>
