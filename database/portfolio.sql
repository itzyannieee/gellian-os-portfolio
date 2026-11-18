SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS yannie_portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE yannie_portfolio;

CREATE TABLE IF NOT EXISTS `profile` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, `full_name` VARCHAR(100) NOT NULL, `display_name` VARCHAR(100) NOT NULL, `site_title` VARCHAR(100) NOT NULL, `logo_text` VARCHAR(100) NOT NULL, `role` VARCHAR(100) NOT NULL, `status` VARCHAR(100) NOT NULL, `location` VARCHAR(100) NOT NULL, `intro` TEXT NOT NULL, `intro_extra` TEXT NOT NULL, `typing_words` VARCHAR(255) NOT NULL, `portrait` VARCHAR(255) NOT NULL, `theme` VARCHAR(100) NOT NULL, `email` VARCHAR(190) NOT NULL, `github` VARCHAR(255) NOT NULL, `facebook` VARCHAR(255) NOT NULL, `instagram` VARCHAR(255) NOT NULL, `linkedin` VARCHAR(255) NOT NULL, `short_goal` TEXT NOT NULL, `long_goal` TEXT NOT NULL, `bio` TEXT NOT NULL, `why_it` TEXT NOT NULL, `interests` TEXT NOT NULL, `motivation` TEXT NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `profile` (`id`, `full_name`, `display_name`, `site_title`, `logo_text`, `role`, `status`, `location`, `intro`, `intro_extra`, `typing_words`, `portrait`, `theme`, `email`, `github`, `facebook`, `instagram`, `linkedin`, `short_goal`, `long_goal`, `bio`, `why_it`, `interests`, `motivation`) VALUES
(1, 'Gellian Nicole C. Gamitin', 'Gellian', 'GELLiAN OS', 'G', 'IT Student', 'Learning', 'Philippines', 'Hi! I''m Gellian Nicole C. Gamitin, an Information Technology student who enjoys learning new things and turning ideas into creative projects through technology.', 'I''m a persistent, optimistic, and curious person who is always willing to improve and explore new skills.', 'Information Technology Student | Creative Learner | Future IT Professional', 'assets/images/profile_pic.png', 'light', 'itzyannieee@gmail.com', 'https://github.com/itzyannieee', 'https://www.facebook.com/itzyannieee/', 'https://www.instagram.com/itzyannieee/', 'https://www.linkedin.com/in/gellian-gamitin-a64779265/', 'Finish my studies successfully, improve my technical and creative skills, and gain more experience through school projects and other opportunities.', 'Find a job after graduation, gain professional experience, and continue developing my skills in the field of Information Technology.', 'Hi! I''m Gellian Nicole C. Gamitin, an Information Technology student from the Philippines.

I am from Mauban, Quezon and currently live in Bayawan City, Negros Oriental. I enjoy learning new things and exploring how technology can turn ideas into useful and creative projects.', 'I became interested in Information Technology because technology gives me different ways to create, solve problems, and express my creativity.

I enjoy combining technical skills with design and creativity to create something meaningful.', 'Outside school, I enjoy watching Korean dramas and other shows, listening to music, playing video games, and making music.

I also enjoy working on school projects because they give me opportunities to practice and improve my skills.', 'I am motivated by my dreams and by the goal of building a better future for myself.

I want to become someone I can be proud of while continuing to learn, grow, and improve.');

CREATE TABLE IF NOT EXISTS `skills` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, `title` VARCHAR(100) NOT NULL, `description` TEXT NOT NULL, `category` VARCHAR(80) NOT NULL, `level` VARCHAR(80) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `skills` (`id`, `title`, `description`, `category`, `level`) VALUES
(1, 'HTML Structure', 'Creating and organizing the structure of web pages using HTML.', 'Technical', 'STILL LEARNING'),
(2, 'JavaScript Basics', 'Learning basic JavaScript concepts and using scripts to add interaction to websites.', 'Technical', 'STILL LEARNING'),
(3, 'CSS Layout', 'Designing web pages using CSS, layouts, spacing, responsive design, and styling.', 'Technical', 'STILL LEARNING'),
(4, 'Animation', 'Interested in creating animations and learning different animation techniques.', 'Creative', 'INTERESTED'),
(5, 'Communication', 'Developing communication skills through school, teamwork, and online tutoring experience.', 'Personal', 'DEVELOPING'),
(6, 'Technical Research', 'Learning how to find, understand, and organize technical information.', 'Technical', 'STILL LEARNING'),
(7, 'Networking', 'Learning computer networking concepts, network configuration, and troubleshooting.', 'Technical', 'STILL LEARNING'),
(8, 'Graphics Design', 'Creating visual designs and graphics using different design tools.', 'Creative', 'BEGINNER');

CREATE TABLE IF NOT EXISTS `projects` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, `title` VARCHAR(160) NOT NULL, `description` TEXT NOT NULL, `category` VARCHAR(80) NOT NULL, `tags` VARCHAR(250) NOT NULL, `image` VARCHAR(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `projects` (`id`, `title`, `description`, `category`, `tags`, `image`) VALUES
(1, 'Comics Design Using Adobe Illustrator', 'A short comics project created using Adobe Illustrator. The project focuses on creating a good quality comic design using digital illustration tools.', 'design', 'Adobe Illustrator | School Project | 2026', 'assets/images/comics-design.png'),
(2, 'Self-Service Book Borrowing Management System', 'A self-service library system that allows students to borrow and return books more easily.', 'development', 'Sublime Text | XAMPP | School Project | 2025', 'assets/images/book-borrowing.png'),
(3, 'Letter Monster', 'A creative design project where a letter was transformed into a monster character using Adobe Illustrator.', 'design', 'Adobe Illustrator | School Project | 2026', 'assets/images/letter-monster.png'),
(4, 'Organizational Chart', 'An organizational chart created for the Computer Science Department using Adobe Photoshop.', 'design', 'Adobe Photoshop | School Project | 2026', 'assets/images/organizational-chart.png');

CREATE TABLE IF NOT EXISTS `education` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, `school` VARCHAR(160) NOT NULL, `period` VARCHAR(80) NOT NULL, `program` VARCHAR(160) NOT NULL, `details` VARCHAR(500) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `education` (`id`, `school`, `period`, `program`, `details`) VALUES
(1, 'Negros Oriental State University', '2024 — 2028', 'Bachelor of Science in Information Technology', 'Third Year'),
(2, 'Bayawan National High School', '2023', 'Senior High School — Accountancy Business and Management (ABM)', '');

CREATE TABLE IF NOT EXISTS `experience` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, `organization` VARCHAR(160) NOT NULL, `role` VARCHAR(120) NOT NULL, `period` VARCHAR(80) NOT NULL, `description` TEXT NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `experience` (`id`, `organization`, `role`, `period`, `description`) VALUES
(1, 'CAS MULTIMEDIA', 'Social Media Manager', '2026', 'Managing posts on the college department''s social media page and helping create content for department activities.');

CREATE TABLE IF NOT EXISTS `achievements` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, `title` VARCHAR(160) NOT NULL, `issuer` VARCHAR(160) NOT NULL, `period` VARCHAR(80) NOT NULL, `description` TEXT NOT NULL, `image` VARCHAR(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `achievements` (`id`, `title`, `issuer`, `period`, `description`, `image`) VALUES
(1, 'CONSISTENT DEAN''S LISTER', 'Negros Oriental State University', '', '', ''),
(2, 'WITH HONOR', 'Bayawan National High School', '', '', ''),
(3, 'CONDUCT AWARDEE', 'Bayawan National High School', '', '', '');

CREATE TABLE IF NOT EXISTS `personal_values` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, `title` VARCHAR(80) NOT NULL, `description` VARCHAR(500) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `personal_values` (`id`, `title`, `description`) VALUES
(1, 'Persistent', 'I keep trying even when things become difficult.'),
(2, 'Optimistic', 'I try to look for positive possibilities.'),
(3, 'Ambitious', 'I continue working toward my goals.'),
(4, 'Responsible', 'I take my tasks and responsibilities seriously.'),
(5, 'Inquisitive', 'I enjoy asking questions and learning new things.');

CREATE TABLE IF NOT EXISTS `future_skills` (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, `title` VARCHAR(80) NOT NULL, `description` VARCHAR(500) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `future_skills` (`id`, `title`, `description`) VALUES
(1, 'Programming', 'Developing programming knowledge and skills.'),
(2, 'Web Development', 'Creating functional and responsive websites.'),
(3, 'UI/UX Design', 'Learning how to create user-friendly interfaces.'),
(4, 'Graphic Design', 'Improving visual design and creative skills.'),
(5, 'Database Management', 'Learning how to organize and manage data.');

CREATE TABLE IF NOT EXISTS administrators (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(80) UNIQUE NOT NULL, password_hash VARCHAR(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS messages (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL, email VARCHAR(190) NOT NULL, subject VARCHAR(150) NOT NULL, message TEXT NOT NULL, is_read TINYINT NOT NULL DEFAULT 0, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS login_attempts (ip_key CHAR(64) PRIMARY KEY, attempts INT NOT NULL, last_attempt DATETIME NOT NULL) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS message_limits (ip_key CHAR(64) PRIMARY KEY, last_sent DATETIME NOT NULL) ENGINE=InnoDB;
