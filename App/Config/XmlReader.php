<?php

namespace App\Config;


class XmlReader implements AbstractReaderInterface
{
    /**
     * @param $config
     * @return \DOMDocument
     */
    private function loadConfig($config)
    {
        $dom = new \DOMDocument();
        $dom->load($config);
        return $dom;
    }

    /**
     * Method reads data from xml configuration file.
     *
     * @param $data
     * @param $source
     * @return \DomNodeList
     */
    public function read($data, $source)
    {
        $preferences = $this->loadConfig($source);
        return $preferences->getElementsByTagName($data);
    }
}