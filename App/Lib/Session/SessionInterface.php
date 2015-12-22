<?php

namespace App\Lib\Session;

interface SessionInterface
{

    public static function set($key, $value);

    public static function get($key);

    public static function has($key);

    public static function delete($key);

    public static function destroy();
}