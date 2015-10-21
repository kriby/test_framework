<?php

namespace App\Config;


class XmlReader implements AbstractReaderInterface
{
    const XML_CONFIG = '/App/etc/di.xml';

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
     * Method reads preference for interface from xml configuration file.
     *
     * @return \DomNodeList
     */
    public function read()
    {
        $preferences = $this->loadConfig(ROOT . self::XML_CONFIG);
        return $preferences->getElementsByTagName('preference');
    }
}