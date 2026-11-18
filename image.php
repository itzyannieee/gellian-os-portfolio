<?php
$file = isset($_GET['file']) && is_string($_GET['file']) ? $_GET['file'] : '';
if (!preg_match('/^[a-f0-9]{32}\.(jpg|png)$/D', $file) || !is_file(__DIR__ . '/storage/' . $file)) { http_response_code(404); exit('Image not found.'); }
header('Content-Type: ' . (str_ends_with($file,'.png') ? 'image/png' : 'image/jpeg'));
header('X-Content-Type-Options: nosniff');
header('Cache-Control: public, max-age=86400');
readfile(__DIR__ . '/storage/' . $file);
