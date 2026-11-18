<?php
require __DIR__ . '/app/start.php';
$profile = getProfile($db);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= h($profile['site_title']) ?> | Resume</title>

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
        <a href="resume.php" class="active">RESUME</a>
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
                RESUME.app
            </div>

            <div class="window-status">
                PROFILE
            </div>

        </div>


        <div class="page-content">

            <div class="page-heading">

                <p class="small-label">
                    MY BACKGROUND
                </p>

                <h1>
                    Resume & <span>Experience</span>
                </h1>

                <p>
                    My education, organization experience, and activities
                    as an Information Technology student.
                </p>

            </div>


            <div class="resume-section">

                <div class="section-heading">

                    <p class="small-label">
                        EDUCATION
                    </p>

                    <h2>
                        Academic Background
                    </h2>

                </div>


                <?php foreach (getRows($db, 'education') as $row): ?>
<div class="timeline-item"><div class="timeline-year"><?= h($row['period']) ?></div><div class="timeline-content"><h3><?= h($row['school']) ?></h3><p><?= h($row['program']) ?></p><p><?= h($row['details']) ?></p></div></div>
<?php endforeach; ?>
</div>

<div class="resume-section">

                <div class="section-heading">

                    <p class="small-label">
                        ORGANIZATION
                    </p>

                    <h2>
                        Activities & Experience
                    </h2>

                </div>


                <?php foreach (getRows($db, 'experience') as $row): ?>
<div class="experience-card"><div class="experience-header"><div><h3><?= h($row['organization']) ?></h3><p><?= h($row['role']) ?></p></div><span><?= h($row['period']) ?></span></div><p><?= h($row['description']) ?></p></div>
<?php endforeach; ?>
</div>
<div class="resume-section"><div class="section-heading"><p class="small-label">RECOGNITION</p><h2>Achievements &amp; Certificates</h2></div><div class="values-grid"><?php foreach (getRows($db, 'achievements') as $row): ?><div class="value-item"><strong><?= h($row['title']) ?></strong><span><?= h($row['issuer']) ?> <?= h($row['period']) ?></span><p><?= h($row['description']) ?></p><?php if ($row['image']): ?><img class="award-image" src="<?= h(imageLink($row['image'])) ?>" alt="<?= h($row['title']) ?>"><?php endif; ?></div><?php endforeach; ?></div></div>
<div class="resume-section">

                <div class="section-heading">

                    <p class="small-label">
                        FUTURE DEVELOPMENT
                    </p>

                    <h2>
                        Career Goals
                    </h2>

                </div>


                <div class="goal-box">

                    <div class="goal-label">
                        SHORT-TERM
                    </div>

                    <p><?= h($profile['short_goal']) ?></p>

                </div>


                <div class="goal-box">

                    <div class="goal-label">
                        LONG-TERM
                    </div>

                    <p><?= h($profile['long_goal']) ?></p>

                </div>

            </div>


            <div class="resume-section">

                <div class="section-heading">

                    <p class="small-label">
                        AREAS OF INTEREST
                    </p>

                    <h2>
                        Future Skills
                    </h2>

                </div>


                <div class="values-grid">
<?php foreach (getRows($db, 'future_skills') as $row): ?><div class="value-item"><strong><?= h($row['title']) ?></strong><span><?= h($row['description']) ?></span></div><?php endforeach; ?>
</div>

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
