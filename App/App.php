<?php
namespace App;

class App
{
    private $router;

    /**
     * App constructor.
     * @param \App\Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run($config, $server)
    {
        try {
            if (!$this->router->parseUrl($server)) {
                $controller = $config['default'];
            } else {
                $controller = $this->router->getControllerName();
            }
            $controller = new $controller();
            $controller->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}
