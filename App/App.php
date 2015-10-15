<?php
namespace App;

class App
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var \App\Request\ActionFactory
     */
    private $actionFactory;

    /**
     * App constructor.
     *
     * @param \App\Router $router
     * @param \App\Request\ActionFactoryInterface $actionFactory
     */
    public function __construct(Router $router, Request\ActionFactoryInterface $actionFactory)
    {
        $this->router = $router;
        $this->actionFactory = $actionFactory;
    }

    /**
     * Main method for running application.
     *
     * @param $server
     */
    public function run($server)
    {
        try {
            $parsedUrl = $this->router->parseUrl($server);
            $controller = $this->mapPathOnClass($parsedUrl);

            $controller = $this->actionFactory->create($controller);
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
