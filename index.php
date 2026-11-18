<?php
require __DIR__ . '/app/start.php';
$profile = getProfile($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($profile['site_title']) ?> | Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body data-default-theme="<?= h($profile['theme']) ?>">

<header class="os-header">

    <div class="os-brand">
        <div class="brand-icon"><?= h($profile['logo_text']) ?></div>
        <span><?= h($profile['site_title']) ?></span>
    </div>

    <nav class="main-nav">
        <a href="index.php">HOME</a>
        <a href="about.php">ABOUT</a>
        <a href="skills.php">SKILLS</a>
        <a href="projects.php">PROJECTS</a>
        <a href="resume.php">RESUME</a>
        <a href="contact.php">CONTACT</a>
    </nav>

    <div class="system-status">
        <span>● ONLINE</span>

        <button id="themeToggle" type="button">◐</button>

        <button
            class="mobile-menu-button"
            id="mobileMenuButton"
            type="button">
            ☰
        </button>
    </div>

</header>


<main class="desktop">

    <section class="profile-window">

        <div class="window-bar">
            <div class="window-title">
                <span class="window-icon"></span>
                GELLiAN_PROFILE.exe
            </div>

            <div class="window-status">
                RUNNING
            </div>
        </div>

        <div class="profile-content">

            <div class="profile-placeholder">
                <img
                    src="<?= h(imageLink($profile['portrait'])) ?>"
                    alt="<?= h($profile['display_name']) ?> Profile">
            </div>

            <div class="profile-text">

                <p class="intro-text">
                    HELLO, I'M
                </p>

                <h1><?= h($profile['display_name']) ?></h1>

                <h2 id="typingText" data-words="<?= h($profile['typing_words']) ?>"><?= h($profile['role']) ?></h2>

                <p class="description"><?= h($profile['intro']) ?></p>

                <p class="description"><?= h($profile['intro_extra']) ?></p>

                <div class="profile-buttons">

                    <a
                        href="projects.php"
                        class="primary-button">
                        EXPLORE MY WORK
                    </a>

                    <a
                        href="about.php"
                        class="secondary-button">
                        VIEW ABOUT ME
                    </a>

                </div>

            </div>

        </div>

    </section>


    <section class="applications-window">

        <div class="window-bar">

            <div class="window-title">
                <span class="window-icon"></span>
                APPLICATIONS
            </div>

            <div class="window-status">
                6 APPS
            </div>

        </div>

        <div class="app-grid">

            <a
                href="about.php"
                class="app-card">

                <div class="app-icon">
                    👩🏻‍💻
                </div>

                <h3>ABOUT_ME.app</h3>

                <p>
                    Learn more about me, my background, education, goals, and interests.
                </p>

            </a>


            <a
                href="skills.php"
                class="app-card">

                <div class="app-icon">
                    💻
                </div>

                <h3>SKILLS.app</h3>

                <p>
                    Explore my technical, creative, and personal skills.
                </p>

            </a>


            <a
                href="projects.php"
                class="app-card">

                <div class="app-icon">
                    🎨
                </div>

                <h3>PROJECTS.app</h3>

                <p>
                    View some of my school projects and creative works.
                </p>

            </a>


            <a
                href="resume.php"
                class="app-card">

                <div class="app-icon">
                    📄
                </div>

                <h3>RESUME.app</h3>

                <p>
                    View my education, activities, training, and experience.
                </p>

            </a>


            <a
                href="contact.php"
                class="app-card">

                <div class="app-icon">
                    ✉️
                </div>

                <h3>CONTACT.app</h3>

                <p>
                    Get in touch with me through my contact information.
                </p>

            </a>


            <a
                href="about.php"
                class="app-card">

                <div class="app-icon">
                    ✦
                </div>

                <h3>PROFILE.app</h3>

                <p>
                    Discover my journey as an Information Technology student.
                </p>

            </a>

        </div>

    </section>


    <section class="system-window">

        <div class="window-bar">

            <div class="window-title">
                <span class="window-icon"></span>
                SYSTEM_INFORMATION
            </div>

            <div class="window-status">
                <?= h($profile['site_title']) ?>
            </div>

        </div>

        <div class="system-grid">

            <div class="system-card">
                <span class="system-label">USER</span>
                <strong><?= h($profile['display_name']) ?></strong>
            </div>

            <div class="system-card">
                <span class="system-label">ROLE</span>
                <strong><?= h($profile['role']) ?></strong>
            </div>

            <div class="system-card">
                <span class="system-label">STATUS</span>
                <strong><?= h($profile['status']) ?></strong>
            </div>

            <div class="system-card">
                <span class="system-label">LOCATION</span>
                <strong><?= h($profile['location']) ?></strong>
            </div>

        </div>

    </section>

</main>


<footer>

    <p>
        © <?= date('Y') ?> <?= h($profile['full_name']) ?>
    </p>

    <p>
        <?= h($profile['site_title']) ?> • Personal Portfolio
    </p>

    <p><a href="admin/index.php">Administrator</a></p>
</footer>


<script src="js/script.js"></script>

</body>
</html>
