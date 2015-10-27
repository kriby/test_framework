<?php

namespace App\Config;


interface ReaderInterface
{
    /**
     * Method reads data specified by client from source
     *
     * @param $tagName
     * @param $source
     * @return mixed
     */
    public function read($tagName, $source);
}