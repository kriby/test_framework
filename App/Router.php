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
     * @throws \Exception
     */
    public function parseUrl($server)
    {
        $path = parse_url($server['REQUEST_URI'], PHP_URL_PATH);
        $this->controller = 'App\\' . ucwords($path[0]) . '\\' . 'Controller\\' . ucwords($path[1]);

        if (preg_match('/([\w]+\/)([\w]+[\/{0,1}])/', $path)) {
            $this->controller = 'App\\' . ucwords($path[0]) . '\\' . 'Controller\\' . ucwords($path[1]);
        } else {
            throw new \Exception('BAD REQUEST.');
        }
    }
}
