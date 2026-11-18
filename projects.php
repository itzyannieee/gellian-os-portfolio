<?php
require __DIR__ . '/app/start.php';
$profile = getProfile($db);
$projects = getRows($db, 'projects');
$categories = array_unique(array_column($projects, 'category'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= h($profile['site_title']) ?> | Projects</title>

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
        <a href="projects.php" class="active">PROJECTS</a>
        <a href="resume.php">RESUME</a>
        <a href="contact.php">CONTACT</a>
    </nav>

    <div class="system-status">
        <span>● ONLINE</span>

        <button id="themeToggle" type="button">
            ◐
        </button>

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
                PROJECTS.app
            </div>

            <div class="window-status">
                <?= count($projects) ?> PROJECTS
            </div>

        </div>


        <div class="page-content">

            <div class="page-heading">

                <p class="small-label">
                    MY WORK
                </p>

                <h1>
                    Projects & <span>Creative Works</span>
                </h1>

                <p>
                    A collection of school projects and creative works
                    that helped me develop my technical and design skills.
                </p>

            </div>


            <div class="project-filter">
<button class="filter-button active" data-filter="all">ALL</button>
<?php foreach ($categories as $category): ?><button class="filter-button" data-filter="<?= h($category) ?>"><?= h(strtoupper($category)) ?></button><?php endforeach; ?>
</div>


            <div class="projects-grid">
<?php foreach ($projects as $number => $project): ?>
<div class="project-card" data-category="<?= h($project['category']) ?>"><div class="project-image-container"><img class="project-image" src="<?= h(imageLink($project['image'])) ?>" alt="<?= h($project['title']) ?>"></div><div class="project-content"><span class="project-number">PROJECT <?= sprintf('%02d', $number + 1) ?></span><h2><?= h($project['title']) ?></h2><p><?= h($project['description']) ?></p><div class="project-details"><?php foreach (explode('|', $project['tags']) as $tag): if (trim($tag) !== ''): ?><span><?= h(trim($tag)) ?></span><?php endif; endforeach; ?></div></div></div>
<?php endforeach; ?>
<?php if (!$projects): ?><p>No projects yet.</p><?php endif; ?>
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
