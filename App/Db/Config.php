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
        return 'mysql:host=localhost; dbname=courses';
    }
    public static function getUsername()
    {
        return 'root';
    }
    public static function getPassword()
    {
        return '123123q';
    }
}