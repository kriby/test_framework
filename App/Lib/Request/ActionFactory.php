<?php

namespace App\Lib\Request;

use App\Container;

class ActionFactory implements ActionFactoryInterface
{
    /**
     * @var \App\Container
     */
    private $container;

    /**
     * ControllerFactory constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {

        $this->container = $container;
    }

    /**
     * @param $name
     * @return object
     */
    public function create($name)
    {
        return $this->container->create($name);
    }
}
