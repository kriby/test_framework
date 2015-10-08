<?php
namespace App;

class App
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var Container
     */
    private $container;

    /**
     * App constructor.
     * @param \App\Router $router
     * @param Container $container
     */
    public function __construct(Router $router, Container $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    public function run($server)
    {
        try {
            $parsedUrl = $this->router->parseUrl($server);
            $controller = $this->mapPathOnClass($parsedUrl);

            $controller = $this->container->get($controller);
            $controller->execute();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    private function mapPathOnClass($parsedUrl)
    {
        return 'App\\' . $parsedUrl['module'] . '\\' . 'Controller\\' . $parsedUrl['action'];
    }
}
