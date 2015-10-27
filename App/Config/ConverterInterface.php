<?php
namespace App\Config;


interface ConverterInterface
{
    public function convert(\DOMNodeList $source);
}
