<?php
/**
 * Contact form endpoint.
 * Validates fields, saves message, then returns json for the front-end.
 */

require_once __DIR__ . '/init.php';

use Portfolio\Database;

header('Content-Type: application/json; charset=UTF-8');

$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

// only allow POST here
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method';
    http_response_code(405);
    echo json_encode($response);
    exit();
}

// read + trim user input
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

// check name
if (empty($name)) {
    $response['errors'][] = 'Name is required';
}

// check email
if (empty($email)) {
    $response['errors'][] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['errors'][] = 'Please enter a valid email address';
}

// check message
if (empty($message)) {
    $response['errors'][] = 'Message is required';
}

// stop early if validation failed
if (!empty($response['errors'])) {
    http_response_code(400);
    echo json_encode($response);
    exit();
}

// save contact message
try {
    $db = new Database();
    
    // first run safety: create table if needed
    $db->execute("CREATE TABLE IF NOT EXISTS contacts (
        contact_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        contact_name VARCHAR(100) NOT NULL,
        contact_email VARCHAR(100) NOT NULL,
        contact_message TEXT NOT NULL,
        contact_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci");
    
    // insert the row with named params
    $query = 'INSERT INTO contacts (contact_name, contact_email, contact_message) VALUES (:name, :email, :message)';
    $db->execute($query, [
        'name' => $name,
        'email' => $email,
        'message' => $message
    ]);
    
    $response['success'] = true;
    $response['message'] = 'Thank you for reaching out! Your message has been sent successfully.';
    http_response_code(200);
    
} catch (Exception $e) {
    error_log("Contact form error: " . $e->getMessage());
    $response['message'] = 'An error occurred while processing your request. Please try again later.';
    $response['errors'][] = 'Database error';
    http_response_code(500);
}

echo json_encode($response);
?>
