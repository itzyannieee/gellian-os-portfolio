<?php
require __DIR__ . '/../app/start.php'; requireAdmin(); require __DIR__ . '/layout.php';
$find=$db->prepare('SELECT * FROM administrators WHERE id=?'); $find->execute([$_SESSION['admin_id']]); $admin=$find->fetch();
if (!$admin) { unset($_SESSION['admin_id']); go('login.php'); }
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    requireToken(); $username=postText('username'); $current=(isset($_POST['current']) && is_string($_POST['current']) ? $_POST['current'] : ''); $password=(isset($_POST['password']) && is_string($_POST['password']) ? $_POST['password'] : '');
    if (!password_verify($current,$admin['password_hash'])) $error='Current password is incorrect.';
    elseif (!preg_match('/^[a-zA-Z0-9_.-]{3,80}$/D',$username)) $error='Use 3–80 letters, numbers, dots, underscores or hyphens for the username.';
    elseif ($password!=='' && (strlen($password)<12 || strlen($password)>72)) $error='Use 12–72 characters for the new password.';
    else {
        $check=$db->prepare('SELECT COUNT(*) FROM administrators WHERE username=? AND id<>?'); $check->execute([$username,$admin['id']]);
        if ($check->fetchColumn()) $error='That username is not available.';
        else { $save=$db->prepare('UPDATE administrators SET username=?,password_hash=? WHERE id=?'); $save->execute([$username,$password===''?$admin['password_hash']:password_hash($password,PASSWORD_DEFAULT),$admin['id']]); session_regenerate_id(true); unset($_SESSION['token']); setNotice('Account updated.'); go('account.php'); }
    }
}
adminTop('My account'); if ($error): ?><p class="error"><?= h($error) ?></p><?php endif; ?><section class="panel"><form method="post"><?= csrfField() ?><label>Username<input name="username" value="<?= h($admin['username']) ?>" required maxlength="80"></label><label>Current password<input name="current" type="password" required autocomplete="current-password"></label><label>New password (leave empty to keep current)<input name="password" type="password" minlength="12" maxlength="72" autocomplete="new-password"></label><button>Update account</button></form></section><?php adminBottom(); ?>
