<?php
session_start();
const DS = DIRECTORY_SEPARATOR;
const ROOT = __DIR__;
const OAUTH_CALLBACK = 'http://rl.dev/test_framework/customer/callback';
const CONSUMER_KEY = 'SCIFEMlr85WbAgESqhcEHeVHu';
const CONSUMER_SECRET = '9I1MBrsYWQTA4VRzJCWar1qsK2lgsxLfmN1U1UQGOmgFXpJ4iC';
require_once('vendor' . DS . 'autoload.php');