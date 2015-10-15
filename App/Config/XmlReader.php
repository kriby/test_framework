<?php

namespace App\Config;


class XmlReader implements AbstractReaderInterface
{
    const XML_CONFIG = '/App/etc/di.xml';

    /**
     * @param $config
     * @return \DOMDocument
     */
    public function loadConfig($config)
    {
        $dom = new \DOMDocument();
        $dom->load($config);
        return $dom;
    }

    /**
     * @param $for
     * @return string
     */
    public function getPreference($for)
    {
        $preferences = $this->loadConfig(ROOT . self::XML_CONFIG);
        $preferences = $preferences->getElementsByTagName('preference');
        foreach($preferences as $preference) {
            if($preference->getAttribute('for') == $for) {
                return $preference->getAttribute('type');
            }
        }
    }
}