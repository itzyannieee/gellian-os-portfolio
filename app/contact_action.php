<?php
$input = ['name'=>'', 'email'=>'', 'subject'=>'', 'message'=>''];
$error = '';
$notice = takeNotice();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireToken();
    foreach ($input as $key => $value) $input[$key] = postText($key);
    if (postText('website') !== '') $error = 'Your message could not be accepted.';
    elseif (strlen($input['name']) < 2 || strlen($input['name']) > 100 || !filter_var($input['email'], FILTER_VALIDATE_EMAIL) || strlen($input['email']) > 190 || strlen($input['subject']) < 2 || strlen($input['subject']) > 150 || strlen($input['message']) < 10 || strlen($input['message']) > 3000) $error = 'Please enter a valid name, email, subject and message (10–3000 characters).';
    else {
        $db->beginTransaction();
        $create = $db->prepare("INSERT IGNORE INTO message_limits (ip_key,last_sent) VALUES (?, '2000-01-01 00:00:00')");
        $create->execute([ipKey()]);
        $check = $db->prepare('SELECT TIMESTAMPDIFF(SECOND,last_sent,NOW()) FROM message_limits WHERE ip_key=? FOR UPDATE');
        $check->execute([ipKey()]);
        if ((int)$check->fetchColumn() < 30) { $db->rollBack(); $error = 'Please wait 30 seconds before sending another message.'; }
        else {
            $save = $db->prepare('INSERT INTO messages (name,email,subject,message) VALUES (?,?,?,?)');
            $save->execute(array_values($input));
            $limit = $db->prepare('UPDATE message_limits SET last_sent=NOW() WHERE ip_key=?');
            $limit->execute([ipKey()]);
            $db->commit();
            setNotice('Message sent. Thank you for reaching out!');
            go('contact.php');
        }
    }
}
