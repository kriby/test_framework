<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('bootstrap.php');

$config = ['default' => 'Base'];

$app = new \App\App();
$app->run($config, $_SERVER);
