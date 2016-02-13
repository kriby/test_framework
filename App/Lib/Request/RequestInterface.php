<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12.02.2016
 * Time: 16:04
 */

namespace App\Lib\Request;


interface RequestInterface
{
    /**
     * Returns $_POST array data.
     *
     * @param null|string $key
     * @return string|array
     */
    public function getPost($key = null);

    /**
     * Returns $_GET array data.
     *
     * @param null|string $key
     * @return string|array
     */
    public function getQuery($key = null);

    /**
     * Returns request headers.
     *
     * @return array
     */
    public function getHeaders();
}