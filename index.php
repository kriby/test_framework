<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('bootstrap.php');

$config = ['default' => 'App\\Customer\\Controller\\Home'];

$app = new \App\App();
$app->run($config, $_SERVER);
