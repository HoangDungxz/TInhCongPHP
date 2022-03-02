<?php

define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require_once(ROOT . 'vendor/autoload.php');
session_start();

use TINHCONG\Dispatcher;

$dispatch = new Dispatcher();
$dispatch->dispatch();

?>