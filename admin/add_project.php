<?php

//  add project handler.
//   takes form data, validates it, then saves a new project row
 

session_start();
require_once '../includes/init.php';

use Portfolio\Database;

// dont allow add unless admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_form.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // grab and trim user input
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image_url = trim($_POST['image_url'] ?? '');
    $url = trim($_POST['url'] ?? '');
    
    // basic required checks
    if (empty($title) || empty($description)) {
        header('Location: add_project_form.php?error=1');
        exit();
    }
    
    try {
        $db = new Database();
        
        // insert project using named params
        $query = 'INSERT INTO projects (project_title, project_description, project_image_url, project_url) VALUES (:title, :description, :image_url, :url)';
        $db->execute($query, [
            'title' => $title,
            'description' => $description,
            'image_url' => $image_url,
            'url' => $url
        ]);
        
        // back to list when save works
        header('Location: project_list.php?success=1');
        exit();
        
    } catch (Exception $e) {
        error_log("Add project error: " . $e->getMessage());
        header('Location: add_project_form.php?error=2');
        exit();
    }
} else {
    // if someone opens this directly, send them back
    header('Location: add_project_form.php');
    exit();
}
?>
