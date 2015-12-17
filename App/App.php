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
            $controller = $this->router->parseUrl($server);

            $controller = $this->actionFactory->create($controller);
            $controller->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


    }
}
