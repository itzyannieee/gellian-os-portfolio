<?php
ini_set('display_errors', '0');
ini_set('log_errors', '1');
$root = dirname(__DIR__);
if (!is_file($root . '/config.local.php')) {
    http_response_code(503);
    exit('Setup needed: create config.local.php and import the database. See README.md.');
}
$config = require $root . '/config.local.php';
$secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
if (PHP_SAPI !== 'cli' && !empty($config['require_https']) && !$secure) {
    http_response_code(403);
    exit('Please open this website using HTTPS.');
}
if (PHP_SAPI !== 'cli') {
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    session_set_cookie_params(['path' => '/', 'httponly' => true, 'secure' => $secure, 'samesite' => 'Lax']);
    session_name('GELLIANOS');
    session_start();
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Cache-Control: no-store');
}
set_exception_handler(function (Throwable $error) {
    error_log($error->getMessage());
    http_response_code(500);
    exit('Something went wrong. Check the server error log or ask the administrator.');
});
try {
    $db = new PDO('mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'] . ';charset=utf8mb4', $config['db_user'], $config['db_password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false]);
} catch (PDOException $error) {
    error_log($error->getMessage());
    http_response_code(503);
    exit('Database unavailable. Check the configuration and MySQL service.');
}
require __DIR__ . '/functions.php';
