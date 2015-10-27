<?php
namespace App\Config;

class Config
{
    const DI_CONFIG = '/App/etc/di.xml';

    const ROUTE_CONFIG = '/App/etc/route.xml';

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
     * @return ReaderInterface
     */
    public function getReader()
    {
        return $this->reader;
    }

    /**
     * @return ConverterInterface
     */
    public function getConverter()
    {
        return $this->converter;
    }
}
