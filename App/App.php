<?php
namespace App;

class App
{
    public function run($config, $server)
    {
        $router = new Router();
        if (!$router->parseUrl($server['REQUEST_URI'])) {
            $controllerName = $config['default'];
        } else {
            $controllerName = $router->getControllerName();
        }
        $controller = new $controllerName();
        $controller->execute();

    }
}