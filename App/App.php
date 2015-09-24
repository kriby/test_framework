<?php
namespace App;

class App
{
    public function run($config, $server)
    {
        $router = new Router($server);



        if (!$router->parseUrl($server)) {
            $controller = $config['default'];
        } else {
            $controller = $router->getControllerName();
        }
        $controller = new $controller();
        $controller->execute();

    }
}
