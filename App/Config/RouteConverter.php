<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 23.10.2015
 * Time: 21:15
 */

namespace App\Config;


class RouteConverter implements ConverterInterface
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
        /** @var \DOMElement $route */
        foreach($nodeList as $route) {
            $result[$route->getAttribute('url')] = $route->getAttribute('class');
        }
        return $result;
    }
}
