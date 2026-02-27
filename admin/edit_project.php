<?php

//  edit project handler
//   updates an existing project row from the edit form
 

session_start();
require_once '../includes/init.php';

use Portfolio\Database;

// admin only
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_form.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get fields from form
    $project_id = $_POST['project_id'] ?? null;
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image_url = trim($_POST['image_url'] ?? '');
    $url = trim($_POST['url'] ?? '');
    
    // quick required validation
    if (!$project_id || empty($title) || empty($description)) {
        header('Location: edit_project_form.php?id=' . $project_id . '&error=1');
        exit();
    }
    
    try {
        $db = new Database();
        
        // update row with named params
        $query = 'UPDATE projects SET project_title = :title, project_description = :description, project_image_url = :image_url, project_url = :url WHERE project_id = :id';
        $db->execute($query, [
            'title' => $title,
            'description' => $description,
            'image_url' => $image_url,
            'url' => $url,
            'id' => $project_id
        ]);
        
        // done, go back to list
        header('Location: project_list.php?success=1');
        exit();
        
    } catch (Exception $e) {
        error_log("Update project error: " . $e->getMessage());
        header('Location: edit_project_form.php?id=' . $project_id . '&error=2');
        exit();
    }
} else {
    // only accept POST here
    header('Location: project_list.php');
    exit();
}
?>
