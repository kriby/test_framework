<?php
namespace App;

class App
{
    public function run($config, $server)
    {
        $router = new Router();

        $path = parse_url($server['REQUEST_URI'], PHP_URL_PATH);

        if (!$router->parseUrl($path)) {
            $controllerName = $config['default'];
        } else {
            $controllerName = $router->getControllerName();
        }
        $controller = new $controllerName();
        $controller->execute();

    }
}
