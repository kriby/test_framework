<?php
namespace App\Config;


class DiConverter implements ConverterInterface
{
    /**
     * Method converts \DomDocument to array.
     *
     * @param \DomNodeList $nodeList
     * @return array
     */
    public function convert(\DomNodeList $nodeList)
    {
        $result = [];
        /** @var $preference \DOMElement */
        foreach($nodeList as $preference) {
            $result[$preference->getAttribute('for')] = $preference->getAttribute('type');
            if($preference->childNodes !== null) {
                foreach($preference->getElementsByTagName('argument') as $childNode) {
                    $result['arguments'][] = $childNode->nodeValue;
                }

            }
        }
        return $result;
    }
}
