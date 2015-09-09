<?php
const DS = DIRECTORY_SEPARATOR;
const ROOT = __DIR__;
function __autoload($className)
{
    if(file_exists(ROOT . DS . 'app' . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . $className . '.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . $className . '.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php');
    }
}