<?php
namespace App;

class Container
{

    private $objects = [];

    public function get($className)
    {
        return $this->objects[$className];
    }
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

    private function resolveArguments($params)
    {
        $result = [];
        if ($params) {
            foreach ($params as $param) {
                $name = $param->getClass()->name;
                if(isset($this->objects[$name])) {
                    $result[] = $this->get($name);
                } else {
                    $this->objects[$name] = $this->create($name);
                    $result[] = $this->get($name);
                }
            }
        }
        return $result;
    }
}