<?php
namespace App;

use App\Config\Config as RouteConfig;

class Router
{
    const ROUTE_CONFIG = '/App/etc/route.xml';

    /**
     * @var RouteConfig
     */
    private $config;

    /**
     * @param RouteConfig $config
     */
    public function __construct(RouteConfig $config)
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

        $routeConfig = $this->config->getConfig('route', ROOT . self::ROUTE_CONFIG);

        if (array_key_exists($path, $routeConfig)) {
            return $routeConfig[$path];
        } else {
            throw new \Exception('BAD REQUEST.');
        }
    }
}
