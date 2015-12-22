<?php
namespace App;

use App\Lib\Action\ActionInterface;

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
     * @param ActionInterface $actionFactory
     */
    public function __construct(Router $router, ActionInterface $actionFactory)
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
