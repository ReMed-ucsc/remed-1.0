<?php
// Simple healthcheck without session
header('Content-Type: application/json');
header('Cache-Control: no-cache');

echo json_encode([
    'status' => 'ok',
    'time' => date('Y-m-d H:i:s'),
    'server' => gethostname()
]);
