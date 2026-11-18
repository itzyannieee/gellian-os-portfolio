<?php
require __DIR__ . '/app/start.php';
$profile = getProfile($db);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= h($profile['site_title']) ?> | About Me</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body data-default-theme="<?= h($profile['theme']) ?>">

    <header class="os-header">

        <div class="os-brand">
            <span class="brand-icon"><?= h($profile['logo_text']) ?></span>
            <span><?= h($profile['site_title']) ?></span>
        </div>

        <nav class="main-nav">

            <a href="index.php">HOME</a>
            <a href="about.php" class="active">ABOUT</a>
            <a href="skills.php">SKILLS</a>
            <a href="projects.php">PROJECTS</a>
            <a href="resume.php">RESUME</a>
            <a href="contact.php">CONTACT</a>

        </nav>

        <div class="system-status">

            <span>● ONLINE</span>

            <button id="themeToggle" type="button" aria-label="Toggle dark mode">
                ◐
            </button>

            <button class="mobile-menu-button" id="mobileMenuButton" type="button">
                ☰
            </button>

        </div>

    </header>


    <main class="page-container">

        <section class="page-window">

            <div class="window-bar">

                <div class="window-title">
                    <span class="window-icon"></span>
                    ABOUT_ME.app
                </div>

                <div class="window-status">
                    PROFILE
                </div>

            </div>


            <div class="page-content">

                <div class="page-heading">

                    <p class="small-label">
                        PERSONAL INFORMATION
                    </p>

                    <h1>
                        About <span>Me</span>
                    </h1>

                    <p>
                        A little information about who I am,
                        where I came from, and what motivates me.
                    </p>

                </div>


                <div class="about-grid">

                    <div class="info-card">

                        <div class="card-number">
                            01
                        </div>

                        <h2>Who I Am</h2>
<p class="multiline"><?= h($profile['bio']) ?></p>

                    </div>


                    <div class="info-card">

                        <div class="card-number">
                            02
                        </div>

                        <h2>Why IT?</h2>
<p class="multiline"><?= h($profile['why_it']) ?></p>

                    </div>


                    <div class="info-card">

                        <div class="card-number">
                            03
                        </div>

                        <h2>What I Enjoy</h2>
<p class="multiline"><?= h($profile['interests']) ?></p>

                    </div>


                    <div class="info-card">

                        <div class="card-number">
                            04
                        </div>

                        <h2>What Motivates Me</h2>
<p class="multiline"><?= h($profile['motivation']) ?></p>

                    </div>

                </div>


                <div class="values-section">

                    <div class="section-heading">

                        <p class="small-label">
                            PERSONAL VALUES
                        </p>

                        <h2>
                            What Describes Me
                        </h2>

                    </div>


                    <div class="values-grid">
<?php foreach (getRows($db, 'personal_values') as $row): ?>
<div class="value-item"><strong><?= h($row['title']) ?></strong><span><?= h($row['description']) ?></span></div>
<?php endforeach; ?>
</div>

                </div>


                <div class="goals-section">

                    <div class="section-heading">

                        <p class="small-label">
                            FUTURE DIRECTION
                        </p>

                        <h2>
                            My Goals
                        </h2>

                    </div>


                    <div class="goals-grid">

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
