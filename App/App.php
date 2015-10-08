<?php
namespace App;

class App
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var ControllerFactory
     */
    private $controllerFactory;

    /**
     * App constructor.
     *
     * @param \App\Router $router
     * @param ControllerFactory $controllerFactory
     */
    public function __construct(Router $router, ControllerFactory $controllerFactory)
    {
        $this->router = $router;
        $this->controllerFactory = $controllerFactory;
    }

    public function run($server)
    {
        try {
            $parsedUrl = $this->router->parseUrl($server);
            $controller = $this->mapPathOnClass($parsedUrl);

            $controller = $this->controllerFactory->create($controller);
            $controller->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    /**
     * Method maps url on controller class to be created.
     *
     * @param $parsedUrl
     * @return string
     */
    private function mapPathOnClass($parsedUrl)
    {
        return 'App\\' . $parsedUrl['module'] . '\\' . 'Controller\\' . $parsedUrl['action'];
    }
}
