<?php
namespace App\Config;


class XmlConverter implements ConverterInterface
{
    /**
     * Method converts \DomDocument to array.
     *
     * @param \DomNodeList $source
     * @return array
     */
    public function convert(\DomNodeList $source)
    {
        $result = [];
        foreach($source as $preference) {
            $result[$preference->getAttribute('for')] = $preference->getAttribute('type');
        }
        return $result;
    }
}