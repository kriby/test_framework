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
        return [
            'dsn' => 'mysql:host=localhost; dbname=courses'
        ];
    }
    public static function getUsername()
    {
        return [
            'db_user' => 'root',
        ];
    }
    public static function getPassword()
    {
        return [
            'db_password' => '123123q'
        ];
    }
}