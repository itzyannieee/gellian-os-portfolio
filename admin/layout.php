<?php
function adminTop($title) { ?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?= h($title) ?> | GELLiAN OS</title><link rel="stylesheet" href="studio.css"></head><body>
<header class="top"><a href="index.php">G / SYSTEM CONTROL</a><span>ADMIN SESSION</span></header>
<div class="workspace"><aside><div class="side-label">CONTROL PANEL</div><a href="index.php">Overview</a><a href="records.php?module=profile">Profile &amp; settings</a><?php foreach (modules() as $module => $fields): if ($module === 'profile') continue; ?><a href="records.php?module=<?= h($module) ?>"><?= h(ucwords(str_replace('_',' ',$module))) ?></a><?php endforeach; ?><a href="mailbox.php">Message inbox</a><a href="account.php">My account</a><a href="../index.php" target="_blank" rel="noopener">Open portfolio ↗</a><form method="post" action="logout.php"><?= csrfField() ?><button class="logout">Sign out</button></form></aside><main><div class="window-title">SYSTEM / <?= h(strtoupper($title)) ?></div><h1><?= h($title) ?></h1><?php $notice = takeNotice(); if ($notice): ?><p class="notice" role="status"><?= h($notice) ?></p><?php endif; ?>
<?php }
function adminBottom() { ?></main></div><footer>GELLiAN OS • Administrative workspace</footer></body></html><?php }
