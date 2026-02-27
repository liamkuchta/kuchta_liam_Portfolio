<?php

//   delete project handler
//   removes one project by id
 

session_start();
require_once '../includes/init.php';

use Portfolio\Database;

// admin only page
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_form.php');
    exit();
}

// read id from query string
$project_id = $_GET['id'] ?? null;

if (!$project_id) {
    header('Location: project_list.php?error=1');
    exit();
}

try {
    $db = new Database();
    
    // delete project safely with param
    $db->execute('DELETE FROM projects WHERE project_id = :id', [
        'id' => $project_id
    ]);
    
    // return to list after delete
    header('Location: project_list.php?deleted=1');
    exit();
    
} catch (Exception $e) {
    error_log("Delete project error: " . $e->getMessage());
    header('Location: project_list.php?error=2');
    exit();
}
?>
