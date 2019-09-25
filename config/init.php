<?php
define('DEBUG', 1);
define('ROOT', dirname(__DIR__));
define('WWW', ROOT . '/public');
define('APP', ROOT . '/app');
define('CORE', ROOT . '/vendor/enterprices/core');
define('LIBS', CORE . '/libs');
define('CACHE', ROOT . '/tmp/cache');
define('CONF', ROOT . '/config');
define('LAYOUT', 'enterprices');

$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
$app_path = preg_replace('/[^\/]+$/iu', '', $app_path);
$app_path = str_replace('/public/', '', $app_path);

define('PATH', $app_path);

require_once ROOT . '/vendor/autoload.php';