<?php
namespace App;

use App\Config\Config;

class Router
{
    const ROUTE_CONFIG = '/App/etc/route.xml';

    /**
     * @var Config
     */
    private $routeConfig;

    /**
     * @param Config $routeConfig
     */
    public function __construct($routeConfig)
    {
        $this->routeConfig = $routeConfig;
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

        $routeConfig = $this->routeConfig->getConfig('route', ROOT . self::ROUTE_CONFIG);


        if (array_key_exists($path, $routeConfig)) {
            return $routeConfig[$path];
        } else {
            throw new \Exception('BAD REQUEST.');
        }
    }
}
