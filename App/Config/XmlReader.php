<?php

namespace App\Config;


class XmlReader implements ReaderInterface
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
     * @param $tagName
     * @param $source
     * @return \DomNodeList
     */
    public function read($tagName, $source)
    {
        $preferences = $this->loadConfig($source);
        return $preferences->getElementsByTagName($tagName);
    }
}
