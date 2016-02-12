<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12.02.2016
 * Time: 16:03
 */

namespace App\Lib\Request;


class RequestObject implements RequestObjectInterface
{
    /**
     * Returns $_POST array data.
     *
     * @param null|string $key
     * @return string|array
     */
    public function getPost($key = null)
    {
        if(!$key) {
            return $_POST;
        } else {
            return $_POST[$key];
        }
    }

    /**
     * Returns $_GET array data.
     *
     * @param null|string $key
     * @return string|array
     */
    public function getQuery($key = null)
    {
        if(!$key) {
            return $_GET;
        } else {
            return $_GET[$key];
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
