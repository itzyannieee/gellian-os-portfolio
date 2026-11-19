<?php
require __DIR__ . '/../app/start.php';
requireAdmin();
require __DIR__ . '/layout.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireToken(); $id=(int)postText('id'); $action=postText('action');
    if ($action==='delete') { $statement=$db->prepare('DELETE FROM messages WHERE id=?'); $statement->execute([$id]); }
    elseif (in_array($action,['read','unread'],true)) { $statement=$db->prepare('UPDATE messages SET is_read=? WHERE id=?'); $statement->execute([$action==='read'?1:0,$id]); }
    else { http_response_code(400); exit('Unknown action.'); }
    setNotice('Inbox updated.'); go('mailbox.php');
}
$messages=$db->query('SELECT * FROM messages ORDER BY id DESC')->fetchAll();
adminTop('Message inbox');
if (!$messages): ?><p class="panel">No messages received.</p><?php endif; foreach ($messages as $message): ?><article class="panel mail"><div class="mail-head"><span class="pill"><?= $message['is_read']?'READ':'NEW' ?></span><small><?= h($message['created_at']) ?></small></div><h2><?= h($message['subject']) ?></h2><p>From <?= h($message['name']) ?> (<?= h($message['email']) ?>)</p><p class="message-body"><?= h($message['message']) ?></p><form method="post"><?= csrfField() ?><input type="hidden" name="id" value="<?= (int)$message['id'] ?>"><button name="action" value="<?= $message['is_read']?'unread':'read' ?>"><?= $message['is_read']?'Mark unread':'Mark read' ?></button> <button class="danger" name="action" value="delete" onclick="return confirm('Delete this message?')">Delete</button></form></article><?php endforeach; adminBottom(); ?>
