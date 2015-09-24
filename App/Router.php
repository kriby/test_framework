<?php
namespace App;

class Router
{
    private $controller;

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controller;
    }

    /**
     * @param $server
     * @return bool
     */
    public function parseUrl($server)
    {
        $path = parse_url($server['REQUEST_URI'], PHP_URL_PATH);
        $this->controller = 'App\\' . ucwords($path[0]) . '\\' . 'Controller\\' . ucwords($path[1]);
    }
}
