<?php

// process_image.php

file_put_contents('php://stderr', "process_image.php script started\n");

if ($argc < 6) {
    file_put_contents('php://stderr', "Usage: php process_image.php <file_tmp_path> <file_name> <file_size> <file_type> <order_id>\n");
    exit("Usage: php process_image.php <file_tmp_path> <file_name> <file_size> <file_type> <order_id>\n");
}

$fileTmpPath = $argv[1];
$fileName = $argv[2];
$fileSize = $argv[3];
$fileType = $argv[4];
$orderId = $argv[5];

file_put_contents('php://stderr', "Arguments received: fileTmpPath=$fileTmpPath, fileName=$fileName, fileSize=$fileSize, fileType=$fileType, orderId=$orderId\n");

// Validate file type and size
$allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];
if (!in_array(strtolower($fileType), $allowedTypes)) {
    file_put_contents('php://stderr', "Invalid file type. Only JPG, JPEG, PNG, and PDF files are allowed.\n");
    exit;
}

if ($fileSize > 5000000) { // 5MB limit
    file_put_contents('php://stderr', "File size exceeds the limit of 5MB.\n");
    exit;
}

// Define target directory and file path
$targetDir = BASE_PATH . '/uploads/prescriptions/';
$targetFile = $targetDir . $orderId . '_' . time() . '.' . $fileType;
$file = $orderId . '_' . time() . '.' . $fileType;

file_put_contents('php://stderr', "Target file path: $targetFile\n");

// Move the file to the target directory
if (!move_uploaded_file($fileTmpPath, $targetFile)) {
    file_put_contents('php://stderr', "Failed to upload file.\n");
    exit;
}

// Log the processing completion
file_put_contents('php://stderr', "File processed: $targetFile\n");

// Add your image processing logic here (e.g., save to database, perform transformations, etc.)

// Example: Save file information to the database
require_once BASE_PATH . '/app/models/MedicineOrder.php';
$processedFileModel = new MedicineOrder();
$data = ['prescription' => $file];
$processedFileModel->update($orderId, $data, "OrderID");

file_put_contents('php://stderr', "Order updated with prescription file: $file\n");
