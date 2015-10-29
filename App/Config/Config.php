<?php
namespace App\Config;

class Config implements ConfigInterface
{
    /**
     * @var ReaderInterface
     */
    private $reader;
    /**
     * @var ConverterInterface
     */
    private $converter;

    /**
     * @param ReaderInterface $reader
     * @param ConverterInterface $converter
     */
    public function __construct(ReaderInterface $reader, ConverterInterface $converter)
    {
        $this->reader = $reader;
        $this->converter = $converter;
    }

    /**
     * Method returns an array with configuration for specified tag in specified source.
     *
     * @param $tagName
     * @param $source
     * @return array
     */
    public function getConfig($tagName, $source)
    {
        $config = $this->reader->read($tagName, $source);
        return $this->converter->convert($config);
    }
}
