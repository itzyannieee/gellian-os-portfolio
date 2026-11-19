<?php
require __DIR__ . '/../app/start.php';
if (!empty($_SESSION['admin_id']) && time()-($_SESSION['last_active']??0)<1800) go('index.php');
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireToken();
    $username = postText('username');
    $password = (isset($_POST['password']) && is_string($_POST['password']) ? $_POST['password'] : '');
    $db->beginTransaction();
    $create = $db->prepare("INSERT IGNORE INTO login_attempts (ip_key,attempts,last_attempt) VALUES (?,0,'2000-01-01 00:00:00')");
    $create->execute([ipKey()]);
    $check = $db->prepare('SELECT attempts,TIMESTAMPDIFF(SECOND,last_attempt,NOW()) AS elapsed FROM login_attempts WHERE ip_key=? FOR UPDATE');
    $check->execute([ipKey()]);
    $limit = $check->fetch();
    $attempts = $limit['elapsed'] >= 900 ? 0 : (int)$limit['attempts'];
    if ($attempts >= 5) { $db->commit(); $error = 'Too many attempts. Try again after 15 minutes.'; }
    else {
        $find = $db->prepare('SELECT * FROM administrators WHERE username=?');
        $find->execute([$username]);
        $admin = $find->fetch();
        if ($admin && strlen($password)<=72 && password_verify($password,$admin['password_hash'])) {
            $clear = $db->prepare('DELETE FROM login_attempts WHERE ip_key=?'); $clear->execute([ipKey()]); $db->commit();
            session_regenerate_id(true); $_SESSION = ['admin_id'=>$admin['id'],'last_active'=>time()]; go('index.php');
        }
        $save = $db->prepare('UPDATE login_attempts SET attempts=?,last_attempt=NOW() WHERE ip_key=?'); $save->execute([$attempts+1,ipKey()]); $db->commit();
        $error = 'Incorrect username or password.';
    }
}
?><!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>System Login</title><link rel="stylesheet" href="studio.css"></head><body class="login"><section class="login-window"><div class="window-title">GELLiAN OS / AUTHENTICATION</div><h1>Unlock control panel</h1><p>Sign in to manage portfolio records.</p><?php if ($error): ?><p class="error" role="alert"><?= h($error) ?></p><?php endif; ?><form method="post"><?= csrfField() ?><label>Username<input name="username" required maxlength="80" autocomplete="username"></label><label>Password<input name="password" type="password" required maxlength="72" autocomplete="current-password"></label><button>Sign in</button></form><a href="../index.php">Return to portfolio</a></section></body></html>
