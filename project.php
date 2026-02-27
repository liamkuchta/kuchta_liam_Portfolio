<?php
require_once __DIR__ . '/includes/init.php';

use Portfolio\Database;

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
// if id is missing, send user back home
if ($id <= 0) {
    header('Location: index.php');
    exit();
}

try {
    $db = new Database();
    // pull one project by id for detail page
    $projects = $db->query('SELECT * FROM projects WHERE project_id = :id', [
        'id' => $id
    ]);
    $project = !empty($projects) ? $projects[0] : null;
} catch (Exception $e) {
    error_log('Could not fetch project: ' . $e->getMessage());
    $project = null;
}

if (!$project) {
    // no project found, avoid showing broken page
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($project['project_title']); ?></title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/grid.css">
    <script type="module" src="js/main.js"></script>
</head>
<body>
    <header>
        <a href="index.php"><img src="images/logo.png" alt="logo" class="logo"></a>
    </header>

    <main class="grid-con">
        <section class="col-span-full">
            <h1><?php echo htmlspecialchars($project['project_title']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($project['project_description'])); ?></p>
            <?php if (!empty($project['project_image_url'])): ?>
                <img src="<?php echo htmlspecialchars($project['project_image_url']); ?>" alt="<?php echo htmlspecialchars($project['project_title']); ?>" style="max-width:100%;height:auto;">
            <?php endif; ?>
            <?php if (!empty($project['project_url'])): ?>
                <p><a href="<?php echo htmlspecialchars($project['project_url']); ?>">View project</a></p>
            <?php endif; ?>
        </section>
    </main>

</body>
</html>
