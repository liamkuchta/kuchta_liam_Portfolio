<?php

 

session_start();

// only admin should access this form
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_form.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Project</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body class="admin">
    <div class="form-container">
        <h1>Add New Project</h1>
        <form action="add_project.php" method="POST">
            <label for="title">Project Title *</label>
            <input type="text" id="title" name="title" required>
            
            <label for="description">Project Description *</label>
            <textarea id="description" name="description" required></textarea>
            
            <label for="image_url">Project Image URL</label>
            <input type="url" id="image_url" name="image_url">
            
            <label for="url">Project URL</label>
            <input type="url" id="url" name="url">
            
            <button type="submit">Add Project</button>
            <a href="project_list.php">Cancel</a>
        </form>
    </div>
</body>
</html>
