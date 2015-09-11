<?php
class App
{
    public function run($config, $server)
    {
        $router = new Router();
        if (!$router->parseUrl($server['REQUEST_URI'], $config)) {
            $controllerName = $config['default'] . 'Controller';
            $actionName = $config['default'] . 'Action';
        } else {
            $controllerName = $router->getControllerName();
        }
        $model = $config['default'] . 'Model';
        $controller = new $controllerName($model);

    }
}