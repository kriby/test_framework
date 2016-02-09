<?php
namespace App;

use App\Lib\Action\ActionInterface;
use App\Lib\Request\ActionFactoryInterface;

class App
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var \App\Lib\Request\ActionFactory
     */
    private $actionFactory;

    /**
     * App constructor.
     *
     * @param \App\Router $router
     * @param ActionFactoryInterface $actionFactory
     */
    public function __construct(Router $router, ActionFactoryInterface $actionFactory)
    {
        session_start();
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
