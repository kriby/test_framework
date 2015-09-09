<?php
require_once('bootstrap.php');
$config = require_once('app' . DIRECTORY_SEPARATOR . 'Config.php');

$app = new App();
$app->run($config, $_SERVER);
