<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12/21/2015
 * Time: 22:43
 */

namespace App\Lib\Session;


class Session
{
    /**
     * Sets session value by specified key.
     *
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Checks if session key is set.
     *
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Returns session value by key or null.
     *
     * @param $key
     * @return string|null
     */
    public static function get($key)
    {
        if (self::has($key)) {
            return $_SESSION[$key];
        }
        return null;
    }

    /**
     * Deletes session value by key.
     *
     * @param $key
     */
    public static function delete($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Starts session.
     */
    public static function start()
    {
        session_start();
    }

    /**
     * Destroys session.
     */
    public static function destroy()
    {
        session_destroy();
    }
}
