<?php
if (PHP_SAPI !== 'cli') { http_response_code(404); exit; }
require __DIR__ . '/../app/start.php';
echo 'Username: '; $username=trim(fgets(STDIN));
echo 'Password (12–72 characters; visible while typing): '; $password=rtrim(fgets(STDIN), "\r\n");
if (!preg_match('/^[a-zA-Z0-9_.-]{3,80}$/D',$username) || strlen($password)<12 || strlen($password)>72) exit("Invalid username or password.\n");
$check=$db->prepare('SELECT COUNT(*) FROM administrators WHERE username=?'); $check->execute([$username]);
if ($check->fetchColumn()) exit("Username already exists.\n");
$save=$db->prepare('INSERT INTO administrators (username,password_hash) VALUES (?,?)'); $save->execute([$username,password_hash($password,PASSWORD_DEFAULT)]);
echo "Administrator created. Open admin/login.php.\n";
