# GELLiAN OS | Secure Dynamic Personal Portfolio

Gellian Nicole C. Gamitin • ITS 300-B final project

Continuation of the original midterm repository: https://github.com/itzyannieee/gellian-os-portfolio

## What this system does

The six original pages are now PHP templates. The original pink operating-system interface, five images, app launcher, typing effect, theme switch, mobile navigation, project filters and image preview remain. MySQL stores profile text, site settings, skills, projects, education, experience, achievements, personal values, future skills and contact messages. The System Control Panel manages them. The project uses PHP/PDO, no framework.

## Requirements

- XAMPP (Apache, PHP 8.1+ and MySQL/MariaDB), or an equivalent PHP-compatible host.
- PHP extensions: PDO MySQL (`pdo_mysql`), Fileinfo, GD (for uploading images), sessions.
- Apache with `.htaccess` enabled; the `storage` folder must be writable by PHP. Never grant broad public write permissions. If the host uses another server, configure equivalent access restrictions before going live.

## Local installation

1. Back up your midterm. Place the **contents** of `01_EDITED_MIDTERM_FILES` and `02_NEW_SYSTEM_FILES` in C:\xampp\htdocs\gellian-os-portfolio. Do not nest the numbered folders. Preserve hidden `.htaccess` and `.gitignore` files.
2. Open XAMPP, start Apache and MySQL. Visit http://localhost/phpmyadmin → Import → choose `database/portfolio.sql` → Import/Go. This creates `yannie_portfolio` with the original portfolio's starter data. Import into a fresh database only; subsequent reimports can restore missing starter rows. Back up your database first if you already have a version.
3. Copy `config.example.php` to `config.local.php` in the project root. Default XAMPP uses host `127.0.0.1`, database `yannie_portfolio`, user `root`, and empty password. Change the values if your installation differs. Do not upload `config.local.php` to GitHub. On a real host use a dedicated database user, not root.
4. Create an administrator in Command Prompt:

   ```bat
   cd /d C:\xampp\htdocs\gellian-os-portfolio
   C:\xampp\php\php.exe tools\create_admin.php
   ```

   Enter your own 3–80 character username and 12–72 byte password. The password is visible while typing in this CLI helper; run it privately. No fixed admin password is supplied. The database stores its hash.
5. Visit http://localhost/gellian-os-portfolio/index.php and http://localhost/gellian-os-portfolio/admin/login.php. Log in using the account you created.
6. If image uploads report that GD is missing, open XAMPP → Apache Config → `php.ini`, enable `extension=gd` (remove leading semicolon if present), and restart Apache. Check `upload_max_filesize` at least 5M, `post_max_size` above 5M (e.g. 8M), and a suitable memory limit (e.g. 256M). Confirm Fileinfo and PDO MySQL are also enabled.

## Admin modules

Overview (live counts); Profile & settings (name, biography, title, logo text, theme default, contact links, goals and portrait); Skills (category and level); Projects (category, image and tags); Education; Experience; Achievements (including certificate image); Personal values; Future skills; Message inbox (read/unread/delete); My account (username/password).

A visitor's saved theme takes precedence over the admin's default theme; clear the `gellianTheme` localStorage key or use a new browser profile to test a changed default. Project tags and the home typing phrases use `|` as a separator. Projects use category names such as `design`, `development`; new categories generate filter buttons automatically. Images accept JPG/PNG only, up to 5 MB and 16 megapixels; uploaded images are decoded and re-encoded in protected storage. Original PNG assets are included. The original recognitions were moved to Achievements, not invented as new certificates.

## Security and hosting

- Passwords are hashed and verified, sessions are regenerated on login and expire following 30 minutes of inactivity. Login is throttled per source IP (five failures, 15-minute cooldown). Contact messages have server validation, a honeypot and a per-IP 30-second send interval. In a reverse-proxy deployment, IP throttling may aggregate users unless the server is configured to expose trusted client IPs safely.
- All data mutations require CSRF tokens; user values use prepared queries; table/column names come from the fixed `app/fields.php` map. Escaped output protects HTML contexts. Contact links are restricted to HTTP/HTTPS. Uploads use unpredictable names, protected storage and re-encoded image bytes.
- Before real hosting, enable HTTPS and set `require_https` to `true` in private config. Ensure Apache actually reports HTTPS; if behind a proxy check the host's trusted HTTPS configuration. Check `/storage/`, `/app/`, `/database/`, `/tools/` and `/config.local.php` are inaccessible by direct HTTP request. Do not deploy if protection fails. Do not commit message data or real administrator hashes/passwords; the included SQL contains only public portfolio starter data.
- GitHub Pages does not execute PHP or MySQL. The original GitHub Pages address may remain an entry page with a link/redirect to approved PHP hosting, but the PHP site will have a separate URL unless the original domain is mapped to the host. Ask the instructor to approve this arrangement; it does not literally preserve every URL. Retain the original HTML until hosting is resolved.
- On shared hosting, create the database in the host's control panel, then import `portfolio.sql` after removing the local `CREATE DATABASE` and `USE` lines if those commands are not allowed. Select the hosted database and configure its issued name/host/user/password privately. Use a fresh database. Upload both sets of application files and the hidden protection files to the web root, with `storage` writable. If there is no terminal, create the admin locally, obtain that row's username and password hash from phpMyAdmin, then insert ONLY that row via the hosted private phpMyAdmin UI (never publish or share the hash). Use a unique password and test HTTPS and direct file-access restrictions. Do not export visitor messages or login-attempt records to a public repository. Keep a private backup of uploaded images and live data, because storage files are gitignored.

## Testing and submission

Use the accompanying `README_START_HERE.md` for the test checklist and `CODE_DEFENSE_GUIDE.md` to study the implementation. The source is prepared with AI assistance; document the assistance honestly and make genuine tested improvements. Commit as each actual feature is developed/tested, not by fabricating a historical development sequence.

Submit the complete source, starter SQL, README, actual screenshots (public pages, login, dashboard, CRUD, database, mobile), real video demonstration links on Facebook and YouTube, GitHub repository and collaborator invitation (`natzjun2@gmail.com`), and the instructor-approved live website link. Submit admin URL and evaluation credentials privately in the LMS only. Check every link and credential before submission.
