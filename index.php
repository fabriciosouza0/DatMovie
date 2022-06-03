<?php

define('PREFIX', 'AniPlus - ');
define('SUFIX', 'Controller');
define('VENDOR', 'app\\');
define('CONTROLLER', VENDOR . 'Controller\\');
define('MODEL', VENDOR . 'app\\Model\\');

require_once 'vendor/autoload.php';

$url = $_REQUEST;

ob_start();
$core = new app\Core\Core();
$core->start($url);
$content = ob_get_contents();
ob_end_clean();

echo $content;
