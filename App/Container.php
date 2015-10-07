<?php
namespace App;

class Container
{
    /**
     * @var array
     */
    private $objects = [];

    public function __construct()
    {
        $this->objects[get_class($this)] = $this;
    }

    /**
     * Method returns an object of requested class. If object does not exist - creates it.
     *
     * @param $className
     * @return mixed
     */
    public function get($className)
    {
        if(!isset($this->objects[$className])) {
            $this->objects[$className] = $this->create($className);
        }
        return $this->objects[$className];
    }


    /**
     * Method creates an instance of a requested class.
     *
     * @param $className
     * @return object
     */
    public function create($className)
    {
        $params = [];
        $class = new \ReflectionClass($className);
        $constructor = $class->getConstructor();
        if ($constructor) {
            $params = $this->resolveArguments($constructor->getParameters());
        }
        return $class->newInstanceArgs($params);
    }

    /**
     * Method returns an array with instances of requested arguments.
     *
     * @param $params
     * @return array
     */
    private function resolveArguments($params)
    {
        $result = [];
        if ($params) {
            foreach ($params as $param) {
                $result[] = $this->get($param->getClass()->name);
            }
        }
        return $result;
    }
}