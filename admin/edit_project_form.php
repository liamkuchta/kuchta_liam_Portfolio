<?php

//  edit project form page
//   loads one project and prefills the form so editing is easy
 

session_start();
require_once '../includes/init.php';

use Portfolio\Database;

// admin gate
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_form.php');
    exit();
}

// get project id from url
$project_id = $_GET['id'] ?? null;

if (!$project_id) {
    header('Location: project_list.php');
    exit();
}

// fetch the project data for the form
try {
    $db = new Database();
    $projects = $db->query('SELECT * FROM projects WHERE project_id = :id', [
        'id' => $project_id
    ]);
    $project = !empty($projects) ? $projects[0] : null;
    
    if (!$project) {
        header('Location: project_list.php?error=1');
        exit();
    }
} catch (Exception $e) {
    error_log("Fetch project error: " . $e->getMessage());
    header('Location: project_list.php?error=2');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Project</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body class="admin admin-edit">
    <div class="form-container">
        <h1>Edit Project</h1>
        <form action="edit_project.php" method="POST">
            <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($project['project_id']); ?>">
            
            <label for="title">Project Title *</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($project['project_title']); ?>" required>
            
            <label for="description">Project Description *</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($project['project_description']); ?></textarea>
            
            <label for="image_url">Project Image URL</label>
            <input type="url" id="image_url" name="image_url" value="<?php echo htmlspecialchars($project['project_image_url'] ?? ''); ?>">
            
            <label for="url">Project URL</label>
            <input type="url" id="url" name="url" value="<?php echo htmlspecialchars($project['project_url'] ?? ''); ?>">
            
            <button type="submit">Update Project</button>
            <a href="project_list.php">Cancel</a>
        </form>
    </div>
</body>
</html>
