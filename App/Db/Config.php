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
    public static function getDsn()
    {
        $url = self::getUrl();
        $server = $url["host"];
        $db = substr($url["path"], 1);
        return "mysql:host=$server; dbname={$db}";
    }

    public static function getUsername()
    {
        $url = self::getUrl();
        return $url["user"];
    }

    public static function getPassword()
    {
        $url = self::getUrl();
        return $url["pass"];
    }

    public static function getDatabaseName()
    {
        $url = self::getUrl();
        return substr($url["path"], 1);
    }

    private static function getUrl()
    {
        return parse_url(getenv("CLEARDB_DATABASE_URL"));
    }
}
