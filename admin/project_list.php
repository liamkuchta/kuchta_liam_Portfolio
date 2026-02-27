<?php

//   admin project list page
//   shows all saved projects so we can edit/delete them fast
 

session_start();
require_once '../includes/init.php';

use Portfolio\Database;

// protect this page, only logged in admin should see it
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_form.php');
    exit();
}

// pull all projects for the table/cards
try {
    $db = new Database();
    $projects = $db->query('SELECT project_id, project_title, project_description FROM projects ORDER BY project_title ASC');
} catch (Exception $e) {
    error_log("Fetch projects error: " . $e->getMessage());
    $projects = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Project List</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body class="admin">
    <div class="admin-container">
        <div class="admin-titlebar">
            <h1>Admin Panel - Projects</h1>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        
        <a href="add_project_form.php" class="add-project-btn">+ Add New Project</a>
        
        <?php if (!empty($projects)): ?>
            <div class="projects-list">
                <?php foreach ($projects as $project): ?>
                    <div class="project-item">
                        <div class="project-info">
                            <h3><?php echo htmlspecialchars($project['project_title']); ?></h3>
                            <p><?php echo htmlspecialchars(substr($project['project_description'], 0, 100)) . '...'; ?></p>
                        </div>
                        <div class="project-actions">
                            <a href="edit_project_form.php?id=<?php echo $project['project_id']; ?>" class="edit-btn">Edit</a>
                            <a href="delete_project.php?id=<?php echo $project['project_id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-projects">
                <p>No projects found. <a href="add_project_form.php">Create one now</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
