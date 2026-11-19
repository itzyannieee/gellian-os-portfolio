<?php
function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function postText($name) {
    return isset($_POST[$name]) && is_string($_POST[$name]) ? trim($_POST[$name]) : '';
}
function queryText($name) {
    return isset($_GET[$name]) && is_string($_GET[$name]) ? $_GET[$name] : '';
}
function go($path) {
    header('Location: ' . $path, true, 303);
    exit;
}
function csrfField() {
    if (empty($_SESSION['token'])) $_SESSION['token'] = bin2hex(random_bytes(32));
    return '<input type="hidden" name="token" value="' . h($_SESSION['token']) . '">';
}
function requireToken() {
    if (empty($_SESSION['token']) || !hash_equals($_SESSION['token'], postText('token'))) {
        http_response_code(403);
        exit('Invalid form token. Reload the page and try again.');
    }
}
function getProfile($db) {
    $person = $db->query('SELECT * FROM profile WHERE id = 1')->fetch();
    if (!$person) throw new RuntimeException('Profile seed missing.');
    return $person;
}
function modules() {
    return require __DIR__ . '/fields.php';
}
function getRows($db, $table) {
    if (!isset(modules()[$table])) throw new InvalidArgumentException('Unknown content table.');
    return $db->query('SELECT * FROM `' . $table . '` ORDER BY id')->fetchAll();
}
function ipKey() {
    return hash('sha256', $_SERVER['REMOTE_ADDR'] ?? 'unknown');
}
function requireAdmin() {
    if (empty($_SESSION['admin_id']) || time() - ($_SESSION['last_active'] ?? 0) > 1800) {
        unset($_SESSION['admin_id'], $_SESSION['last_active']);
        go('login.php');
    }
    $_SESSION['last_active'] = time();
}
function imageLink($value) {
    if (preg_match('~^assets/images/[a-zA-Z0-9_.-]+\.(?:png|jpg|jpeg|webp)$~iD', $value) && is_file(dirname(__DIR__) . '/' . $value)) return $value;
    if (preg_match('/^[a-f0-9]{32}\.(jpg|png)$/D', $value)) return 'image.php?file=' . rawurlencode($value);
    return 'placeholder.svg';
}
function uploadImage($field) {
    if (!isset($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) return null;
    $file = $_FILES[$field];
    if (!is_int($file['error']) || $file['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name']) || $file['size'] > 5 * 1024 * 1024) throw new InvalidArgumentException('Choose one valid JPG or PNG up to 5 MB.');
    $info = @getimagesize($file['tmp_name']);
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
    if (!$info || !in_array($mime, ['image/jpeg','image/png'], true) || $info['mime'] !== $mime || $info[0] * $info[1] > 16000000) throw new InvalidArgumentException('Only real JPG/PNG images up to 16 megapixels are allowed.');
    if (!extension_loaded('gd')) throw new InvalidArgumentException('Enable the PHP GD extension before uploading images.');
    $picture = $mime === 'image/png' ? @imagecreatefrompng($file['tmp_name']) : @imagecreatefromjpeg($file['tmp_name']);
    if (!$picture) throw new InvalidArgumentException('The image could not be decoded.');
    $name = bin2hex(random_bytes(16)) . ($mime === 'image/png' ? '.png' : '.jpg');
    $path = dirname(__DIR__) . '/storage/' . $name;
    if ($mime === 'image/png') { imagealphablending($picture, false); imagesavealpha($picture, true); $ok = imagepng($picture, $path); }
    else { $ok = imagejpeg($picture, $path, 90); }
    imagedestroy($picture);
    if (!$ok) { @unlink($path); throw new InvalidArgumentException('Unable to store the image. Check folder permissions.'); }
    return $name;
}
function removeUnusedImage($db, $name) {
    if (!preg_match('/^[a-f0-9]{32}\.(jpg|png)$/D', $name)) return;
    foreach (['profile'=>'portrait','projects'=>'image','achievements'=>'image'] as $table => $column) {
        $check = $db->prepare("SELECT COUNT(*) FROM `$table` WHERE `$column` = ?");
        $check->execute([$name]);
        if ($check->fetchColumn()) return;
    }
    @unlink(dirname(__DIR__) . '/storage/' . $name);
}
function setNotice($message) { $_SESSION['notice'] = $message; }
function takeNotice() { $message = $_SESSION['notice'] ?? ''; unset($_SESSION['notice']); return $message; }

function safeLink($url) {
    return filter_var($url, FILTER_VALIDATE_URL) && in_array(strtolower(parse_url($url, PHP_URL_SCHEME)), ['http','https'], true) ? $url : '#';
}
