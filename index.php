<?php

require_once 'vendor/autoload.php';

$url = $_REQUEST;

$core = new app\Core\Core();
$content = $core->start($url);

echo $content;