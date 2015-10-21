<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__);

require_once('vendor' . DS . 'autoload.php');

$bootstrap = new \App\Bootstrap;
$app = $bootstrap->createApplication('\App\App');
$app->run($_SERVER);
