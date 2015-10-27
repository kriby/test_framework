<?php
namespace App;

use App\Config\Config;

class Router
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     * @internal param Config\RouteConverter $routeConverter
     * @internal param Config\XmlReader $reader
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
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

        $routeConfig = $this->config->getReader()->read('route', ROOT . Config::ROUTE_CONFIG);
        $routeConfig = $this->config->getConverter()->convert($routeConfig);


        if (array_key_exists($path, $routeConfig)) {
            return $routeConfig[$path];
        } else {
            throw new \Exception('BAD REQUEST.');
        }
    }
}
