<?php
require __DIR__ . '/../app/start.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }
requireToken();
$_SESSION = [];
$cookie = session_get_cookie_params();
setcookie(session_name(), '', ['expires'=>time()-3600,'path'=>$cookie['path'],'secure'=>$cookie['secure'],'httponly'=>true,'samesite'=>'Lax']);
session_destroy();
go('login.php');
