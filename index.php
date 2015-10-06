<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('bootstrap.php');

$bootstrap = new \App\Bootstrap;
$app = $bootstrap->createApplication('\\App\\App');
$app->run($config, $_SERVER);
