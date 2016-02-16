<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12/20/2015
 * Time: 22:15
 */
namespace App\Db;

class Config
{
    private static $db = 'courses';

    public static function getDsn()
    {
        $db = self::$db;
        return "mysql:host=localhost; dbname={$db}";
    }

    public static function getUsername()
    {
        return 'root';
    }

    public static function getPassword()
    {
        return '123123q';
    }

    public static function getDatabaseName()
    {
        return self::$db;
    }
}
