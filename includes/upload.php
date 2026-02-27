<?php
/**
 * Upload endpoint for project images.
 * We do basic checks (type/size) then move file into images folder.
 */

header('Content-Type: application/json; charset=UTF-8');
require_once __DIR__ . '/init.php';

$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

// uploads must come as POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method';
    http_response_code(405);
    echo json_encode($response);
    exit();
}

// allowed mime types + max size limit
$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
$max_file_size = 5 * 1024 * 1024; // 5MB
$upload_dir = '../images/';

// make sure file is present
if (!isset($_FILES['file'])) {
    $response['errors'][] = 'No file uploaded';
    http_response_code(400);
    echo json_encode($response);
    exit();
}

$file = $_FILES['file'];

// size check
if ($file['size'] > $max_file_size) {
    $response['errors'][] = 'File size exceeds 5MB limit';
}

// type check
if (!in_array($file['type'], $allowed_types)) {
    $response['errors'][] = 'File type not allowed. Only JPG, PNG, and GIF are accepted.';
}

// native php upload error check
if ($file['error'] !== UPLOAD_ERR_OK) {
    $response['errors'][] = 'File upload error: ' . $file['error'];
}

// stop if any check failed
if (!empty($response['errors'])) {
    http_response_code(400);
    echo json_encode($response);
    exit();
}

// create unique filename so files dont overwrite
$file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
$new_filename = uniqid('img_', true) . '.' . $file_ext;
$upload_path = $upload_dir . $new_filename;

// move temp file into final folder
if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
    $response['message'] = 'Failed to save file';
    http_response_code(500);
    echo json_encode($response);
    exit();
}

// success response
$response['success'] = true;
$response['message'] = 'File uploaded successfully';
$response['file_name'] = $new_filename;
$response['file_path'] = 'images/' . $new_filename;
http_response_code(200);

echo json_encode($response);
?>
