<?php
require __DIR__ . '/../app/start.php';
requireAdmin();
require __DIR__ . '/layout.php';
adminTop('Workspace overview');
$counts = ['Skills'=>'skills','Projects'=>'projects','Education'=>'education','Experience'=>'experience','Achievements'=>'achievements','Messages'=>'messages'];
?><p class="muted">Your portfolio database is connected. Select a module to update the public website.</p><div class="tiles"><?php foreach ($counts as $label=>$table): ?><a class="tile" href="<?= $table === 'messages' ? 'mailbox.php' : 'records.php?module=' . h($table) ?>"><span><?= h($label) ?></span><strong><?= (int)$db->query('SELECT COUNT(*) FROM `' . $table . '`')->fetchColumn() ?></strong><small>Open module →</small></a><?php endforeach; ?></div><section class="panel"><h2>Quick actions</h2><p>Update your profile, publish a project or review visitor messages. Every saved record appears on the public website after refreshing.</p><a class="button" href="records.php?module=projects">Manage projects</a> <a href="mailbox.php">View inbox (<?= (int)$db->query('SELECT COUNT(*) FROM messages WHERE is_read=0')->fetchColumn() ?> unread)</a></section><?php adminBottom(); ?>
