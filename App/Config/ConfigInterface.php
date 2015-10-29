<?php
namespace App\Config;


interface ConfigInterface
{
    /**
     * Method returns an array with configuration for specified tag in specified source.
     *
     * @param $tagName
     * @param $source
     * @return array
     */
    public function getConfig($tagName, $source);
}