<?php
class App
{
    public function run($config, $server)
    {
        $router = new Router();
        if (!$router->parseUrl($server['REQUEST_URI'])) {
            $controllerName = $config['defaultController'] . 'Controller';
            $actionName = $config['defaultController'] . 'Action';
        } else {
            $controllerName = $router->getControllerName();
        }
        $model = $config['defaultController'] . 'Model';
        $controller = new $controllerName($model);

    }
}