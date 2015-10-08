<?php

namespace App;


class ControllerFactory
{
    /**
     * @var Container
     */
    private $container;

    /**
     * ControllerFactory constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {

        $this->container = $container;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function create($name)
    {
        return $this->container->create($name);
    }
}