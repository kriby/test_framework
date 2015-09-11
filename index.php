<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('bootstrap.php');

$config = require_once('app' . DIRECTORY_SEPARATOR . 'Config.php');

$app = new App();
$app->run($config, $_SERVER);
