<?php
require __DIR__ . '/app/start.php';
$profile = getProfile($db);
$skills = getRows($db, 'skills');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= h($profile['site_title']) ?> | Skills</title>

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
        <a href="skills.php" class="active">SKILLS</a>
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


<main class="page-container">

    <section class="page-window">

        <div class="window-bar">

            <div class="window-title">
                <span class="window-icon">●</span>
                SKILLS.app
            </div>

            <div class="window-status">
                SKILL SET
            </div>

        </div>


        <div class="page-content">

            <div class="page-heading">

                <p class="small-label">
                    MY SKILLS
                </p>

                <h1>
                    Skills & <span>Abilities</span>
                </h1>

                <p>
                    The technical, creative, and personal skills I am
                    currently developing as an Information Technology student.
                </p>

            </div>


            <div class="skills-grid">
<?php foreach ($skills as $number => $skill): ?>
<div class="skill-card"><div class="skill-number"><?= sprintf('%02d', $number + 1) ?></div><h2><?= h($skill['title']) ?></h2><p><?= h($skill['description']) ?></p><span class="skill-status"><?= h($skill['level']) ?></span><p class="small-label"><?= h($skill['category']) ?></p></div>
<?php endforeach; ?>
<?php if (!$skills): ?><p>No skills yet.</p><?php endif; ?>
</div>

        </div>

    </section>

</main>


<footer>

    <p>
        © <?= date('Y') ?> <?= h($profile['full_name']) ?>
    </p>

    <p>
        <?= h($profile['site_title']) ?> — Personal Portfolio
    </p>

    <p><a href="admin/index.php">Administrator</a></p>
</footer>


<script src="js/script.js"></script>

</body>
</html>
