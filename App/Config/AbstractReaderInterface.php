<?php

namespace App\Config;


interface AbstractReaderInterface
{
    /**
     * Method reads data specified by client from source
     *
     * @param $data
     * @param $source
     * @return mixed
     */
    public function read($data, $source);
}