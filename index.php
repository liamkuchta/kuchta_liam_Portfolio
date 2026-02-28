<?php
require_once __DIR__ . '/includes/init.php';

use Portfolio\Database;

// load projects for homepage cards
try {
    $db = new Database();
    $projects = $db->query('SELECT project_id, project_title, project_image_url, project_url, project_description FROM projects ORDER BY created_at DESC');
} catch (Exception $e) {
    error_log('Could not fetch projects: ' . $e->getMessage());
    $projects = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Liam Kuchta portfolio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/grid.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script type="module" src="js/main.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Zalando+Sans+SemiExpanded:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">

</head>

<body>

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


    <section id="hero">
        <h2>LIAM <br>KUCHTA</h2> <br>

    </section>
    <section id="dev-motion-designer">
        <h3>MOTION & <br> GRAPHIC DESIGNER </h3>
    </section>

      <section id="videosection">
        <h2 class="hidden">video</h2>
        <div class="video-container ">
            <video controls muted autoplay loop class="hero-video">
                <source src="video/test6.mp4" type="video/mp4">

            </video>
        </div>
    </section>

    <section id="bio">
        <h2 class="hidden"> bio section</h2>
        <div id="bio-text">
           <img id="headshot" src="images/headshot_1.png" alt="headshot">
            <p>Hey! I'm Liam and I’m a motion and graphic designer. I make
                clean and on-theme designs for brands and websites. I spend most of my time in
                Cinema4d and Adobe Suite, as well as doing traditional drawing (if you ever need a portrait). I live for
                turning ideas into beautiful interactive experiences. 
                My
                goal
                is to deliver flawless digital designs that balance both
                functionality and aesthetics.</p>
        </div>
    </section>

  



    <section class="strip-section">
        <h2 class="hidden">strip</h2>
        <div id="top-stripe" class="scrolling-strip">
            <div class="scrolling-text">
                <span>KUCHTA WEB DESIGN</span> •
                <span>KUCHTA WEB DESIGN</span> •
                <span>KUCHTA WEB DESIGN</span> •
                <span>KUCHTA WEB DESIGN</span> •
                <span>KUCHTA WEB DESIGN</span> •
                <span>KUCHTA WEB DESIGN</span> •
            </div>
        </div>

        <div id="bottom-stripe" class="scrolling-strip">
            <div class="scrolling-text">
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
               

            </div>
        </div>
    </section>
<!-- PROJECTS PROJECTS PROJECTS PROJECTS PROJECTS PROJECTS PROJECTS PROJECTS PROJECTS PROJECTS PROJECTS PROJECTS PROJECTS PROJECTS PROJECTS PROJECTS -->

    <section  id="projects " class="projects-section">
        <h2 class="hidden">The projects</h2>
        <div id="works-link"  class="grid-con">
 
            <!-- <div class="col-span-full">

                <h2 id="works-link" class="section-title">RECENT WORKS </h2>
            </div> -->

            <div class="col-span-full project-grid">

                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                        <div class="project-item">
                            <div class="project-box">
                                <a href="project.php?id=<?php echo $project['project_id']; ?>">
                                    <img src="<?php echo htmlspecialchars($project['project_image_url']); ?>" alt="<?php 
                                    echo htmlspecialchars($project['project_title']); ?>" class="project-img">
                                </a>
                            </div>
                            <p class="project-label"><?php echo htmlspecialchars($project['project_title']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No projects found.</p>
                <?php endif; ?>

            </div>

        </div>
    </section>

     <section class="strip-section2">
        <h2 class="hidden">strip</h2>
        <div id="top-stripe2" class="scrolling-strip2">
            <div class="scrolling-text2">
                <span>KUCHTA WEB DESIGN</span> •
                <span>KUCHTA WEB DESIGN</span> •
                <span>KUCHTA WEB DESIGN</span> •
                <span>KUCHTA WEB DESIGN</span> •
                <span>KUCHTA WEB DESIGN</span> •
                <span>KUCHTA WEB DESIGN</span> •
            </div>
        </div>

        <div id="bottom-stripe2" class="scrolling-strip2">
            <div class="scrolling-text2">
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
                <span>RECENT WORKS</span> •
               

            </div>
        </div>
    </section>


    <div id="contact-title">
        <h3>Get in touch</h3>
    </div>

    <section id="order">
        <h2 class="hidden">Order</h2>

        <form id="contact-form" novalidate>
            <input type="text" id="name_input" name="name" placeholder="Name" required><br>

            <input type="email" id="email_input" name="email" placeholder="Email" required><br>

            <textarea id="message_input" name="message" placeholder="Message" required></textarea><br>

            <button id="send-btn" type="submit">Send</button>
        </form>

    </section>



    <footer class="grid-con">
        <div id="footer-text" class="col-start-1 col-span-full 
            m-col-start-0 m-col-end-5 l-col-start-2 l-col-end-5">
            <img id="footer-logo" src="images/logo.png" alt="liam kuchta logo" class="logo">
            <p>Liam Kuchta <br>
                © 2025 All Rights Reserved.</p>
            <p>
                London, Ontario Canada </p>
            <div id="socials">
                <img id="x-icon" src="images/x.svg" alt="x">
                <img id="insta-icon" src="images/instagram.svg" alt="ig">
                <img id="linkedin-icon" src="images/linkedin-svgrepo-com.svg" alt="linked">
                <img id="youtube-icon" src="images/youtube-168-svgrepo-com.svg" alt="tube">
            </div>
        </div>
        <div class="col-start-1 col-span-full m-col-start-6 m-col-span-auto l-col-start-8 l-col-span-auto">
            <div id="footer-buttons">
                <h2> LK Motion and Graphics</h2>
                <button>
                    Details
                </button>
                <button>
                    Location
                </button>
            </div>
            <div id="footer-contact">
                <button>
                    Contact
                </button>
                <p>+1 226-377-9308</p>
                <p>liamkuchta@gmail.com</p>
            </div>

        </div>

    </footer>

    <!-- <script src="/js/main.js"></script> -->
</body>

</html>
