<?php
namespace App;

use App\Config\RouteConverter;
use App\Config\XmlReader;

class Router
{
    const XML_CONFIG = '/App/etc/route.xml';

    /**
     * @var Config\RouteConverter
     */
    private $routeConverter;

    /**
     * @var Config\XmlReader
     */
    private $reader;

    /**
     * @param Config\RouteConverter $routeConverter
     * @param Config\XmlReader $reader
     */
    public function __construct(RouteConverter $routeConverter, XmlReader $reader)
    {

        $this->routeConverter = $routeConverter;
        $this->reader = $reader;
    }

    /**
     * Method parses requested url and returns an array with Module name and Action name.
     *
     * @param $server
     * @return array
     * @throws \Exception
     */
    public function parseUrl($server)
    {
        $path = parse_url($server['REQUEST_URI'], PHP_URL_PATH);

        $routeConfig = $this->reader->read('route', ROOT . self::XML_CONFIG);
        $routeConfig = $this->routeConverter->convert($routeConfig);


        if (array_key_exists($path, $routeConfig)) {
            return $routeConfig[$path];
        } else {
            throw new \Exception('BAD REQUEST.');
        }
    }
}
