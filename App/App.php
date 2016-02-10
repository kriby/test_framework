<?php
namespace App;

use App\Lib\Request\ActionFactoryInterface;
use App\Lib\Session\Session;

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
        Session::start();
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
