<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12.02.2016
 * Time: 16:03
 */

namespace App\Lib\Request;


class Request
{
    /**
     * Returns $_POST array data.
     *
     * @param null|string $key
     * @return string|array|null
     */
    public function getPost($key = null)
    {
        if(!$key) {
            return $_POST;
        } else {
            return isset($_POST[$key]) ? $_POST[$key] : null;
        }
    }

    /**
     * Returns $_GET array data.
     *
     * @param null|string $key
     * @return string|array|null
     */
    public function getQuery($key = null)
    {
        if(!$key) {
            return $_GET;
        } else {
            return isset($_GET[$key]) ? $_GET[$key] : null;
        }
    }

    /**
     * Returns request headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return getallheaders();
    }
}
