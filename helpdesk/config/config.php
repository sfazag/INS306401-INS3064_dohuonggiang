<?php

/*
|--------------------------------------------------------------------------
| DATABASE CONFIG
|--------------------------------------------------------------------------
*/

define('DB_HOST', 'localhost');
define('DB_NAME', 'campus_helpdesk');
define('DB_USER', 'root');
define('DB_PASS', '');

define('APP_NAME', 'Campus Helpdesk');

define('APP_URL', 'http://localhost/helpdesk');


define('UPLOAD_PATH', __DIR__ . '/../uploads/');

define('TICKET_UPLOAD_PATH', UPLOAD_PATH . 'tickets/');
define('CHAT_UPLOAD_PATH', UPLOAD_PATH . 'chat_files/');
define('AVATAR_UPLOAD_PATH', UPLOAD_PATH . 'avatars/');

date_default_timezone_set('Asia/Ho_Chi_Minh');


error_reporting(E_ALL);
ini_set('display_errors', 1);