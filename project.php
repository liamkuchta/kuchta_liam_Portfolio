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
     <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">
</head>
<body class="project-body">
    <header class="grid-con">
        <h1 class="hidden">Header</h1>
        <h2 class="hidden">logo</h2>
        <div class="col-span-2 m-col-span-2 l-col-span-2">

            <a href="index.php"><img src="images/logo.png" alt="liam logo" class="logo"></a>
        </div>

        <nav id="nav" class="col-start-3 m-col-start-3 m-col-span-6 l-col-start-7 l-col-span-5">
            <!-- bamburger button -->
            <button class="nav-toggle" id="navToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- nav menu -->
            <ul class="nav-menu" id="navMenu">
                <li><a href="#works-link">WORKS</a></li>
              
                <li><a href="#contact-title">CONTACT</a></li>

            </ul>
        </nav>
    </header>

    <main >
        <section class=" project-all-items">
           
            <?php if (!empty($project['project_image_url'])): ?>
                <img class="project-pic" src="<?php echo htmlspecialchars($project['project_image_url']); ?>" alt="<?php 
                    echo htmlspecialchars($project['project_title']); ?>" style="max-width:40%;">
            <?php endif; ?>
             <h1><?php echo htmlspecialchars($project['project_title']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($project['project_description'])); ?></p>
            <?php if (!empty($project['project_url'])): ?>
                <p><a class="view-project"  href="<?php echo htmlspecialchars($project['project_url']); ?>">View project</a></p>
            <?php endif; ?>
        </section>
    </main>

</body>
</html>
