<?php
require __DIR__ . '/app/start.php';
$profile = getProfile($db);
require __DIR__ . '/app/contact_action.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= h($profile['site_title']) ?> | Contact</title>

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
        <a href="contact.php" class="active">CONTACT</a>
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
                CONTACT.app
            </div>

            <div class="window-status">
                OPEN
            </div>

        </div>


        <div class="page-content">

            <div class="page-heading">

                <p class="small-label">
                    GET IN TOUCH
                </p>

                <h1>
                    Contact <span>Me</span>
                </h1>

                <p>
                    Feel free to connect with me through my social
                    media accounts or send me a message.
                </p>

            </div>


            <div class="contact-grid">


                <div class="contact-information">

                    <div class="section-heading">

                        <p class="small-label">
                            CONTACT INFORMATION
                        </p>

                        <h2>
                            Let's Connect
                        </h2>

                    </div>


                    <div class="contact-item">

                        <div class="contact-icon">
                            @
                        </div>

                        <div>

                            <span>
                                EMAIL
                            </span>

                            <a href="mailto:<?= h($profile['email']) ?>"><?= h($profile['email']) ?>
                            </a>

                        </div>

                    </div>


                    <div class="contact-item">

                        <div class="contact-icon">
                            G
                        </div>

                        <div>

                            <span>
                                GITHUB
                            </span>

                            <a
                                href="<?= h(safeLink($profile['github'])) ?>"
                                target="_blank" rel="noopener noreferrer">
                                <?= h($profile['github']) ?>
                            </a>

                        </div>

                    </div>


                    <div class="contact-item">

                        <div class="contact-icon">
                            F
                        </div>

                        <div>

                            <span>
                                FACEBOOK
                            </span>

                            <a
                                href="<?= h(safeLink($profile['facebook'])) ?>"
                                target="_blank" rel="noopener noreferrer">
                                <?= h($profile['facebook']) ?>
                            </a>

                        </div>

                    </div>


                    <div class="contact-item">

                        <div class="contact-icon">
                            I
                        </div>

                        <div>

                            <span>
                                INSTAGRAM
                            </span>

                            <a
                                href="<?= h(safeLink($profile['instagram'])) ?>"
                                target="_blank" rel="noopener noreferrer">
                                <?= h($profile['instagram']) ?>
                            </a>

                        </div>

                    </div>


                    <div class="contact-item">

                        <div class="contact-icon">
                            IN
                        </div>

                        <div>

                            <span>
                                LINKEDIN
                            </span>

                            <a
                                href="<?= h(safeLink($profile['linkedin'])) ?>"
                                target="_blank" rel="noopener noreferrer">
                                <?= h($profile['linkedin']) ?>
                            </a>

                        </div>

                    </div>

                </div>


                <div class="contact-form-container">

                    <div class="section-heading">

                        <p class="small-label">
                            SEND A MESSAGE
                        </p>

                        <h2>
                            Contact Form
                        </h2>

                    </div>


                    <form id="contactForm" method="post" action="contact.php">
<?= csrfField() ?>
<div class="trap" aria-hidden="true"><label>Leave blank <input name="website" tabindex="-1" autocomplete="off"></label></div>


                        <div class="form-group">

                            <label for="name">
                                NAME
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name" required maxlength="100" value="<?= h($input['name']) ?>"
                                placeholder="Enter your name">

                        </div>


                        <div class="form-group">

                            <label for="email">
                                EMAIL
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email" required maxlength="190" value="<?= h($input['email']) ?>"
                                placeholder="Enter your email">

                        </div>


                        <div class="form-group">

                            <label for="subject">SUBJECT</label><input id="subject" name="subject" required maxlength="150" value="<?= h($input['subject']) ?>"></div><div class="form-group"><label for="message">
                                MESSAGE
                            </label>

                            <textarea
                                id="message"
                                name="message" required minlength="10" maxlength="3000"
                                rows="6"
                                placeholder="Write your message"><?= h($input['message']) ?></textarea>

                        </div>


                        <button
                            type="submit"
                            class="primary-button">
                            SEND MESSAGE
                        </button>


                        <p id="formMessage" role="status" class="<?= $error ? 'form-error' : 'form-success' ?>"><?= h($error ?: $notice) ?></p>

                    </form>

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
