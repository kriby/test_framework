<?php
namespace App;

use App\Config\Config;

class Container
{
    const DI_CONFIG = '/App/etc/di.xml';

    /**
     * @var array
     */
    private $objects = [];

    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->objects[get_class($this)] = $this;
        $this->config = $config;
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
            return $this->objects[$className] = $this->create($className);
        }
        return $this->objects[$className];
    }


    /**
     * Method creates an instance of a requested class.
     *
     * @param $type
     * @return object
     */
    public function create($type)
    {
        $class = new \ReflectionClass($type);
        $constructor = $class->getConstructor();
        if ($constructor) {
            $params = $this->resolveArguments($constructor->getParameters());
            if($params['realType'] != '') {
                $realType = new \ReflectionClass($params['realType']);
                $params = ['args' => [$realType->newInstanceArgs($params['args'])]];
            }
            return $class->newInstanceArgs($params['args']);
        }
        return $class->newInstanceArgs();
    }

    /**
     * Method returns an array with instances of requested arguments.
     *
     * @param \ReflectionParameter[] $params
     * @return array
     */
    private function resolveArguments(array $params)
    {
        $result = ['realType' => '', 'args' => ''];
        if ($params) {
            foreach ($params as $param) {
                if($param->getClass() == null) {
                    $config = $this->config->getConfig('virtualType', ROOT . self::DI_CONFIG);
                    $realType = $param->name;
                    $result['realType'] = $config[$realType];
                    foreach($config['arguments'] as $argument) {
                        $result['args'][] = $this->create($argument);
                    }
                } elseif($param->getClass()->isInterface()) {
                    $config = $this->config->getConfig('preference', ROOT . self::DI_CONFIG);
                    $className = $this->getPreference($config, $param->getClass()->name);
                    $result['args'][] = $this->get($className);
                } else {
                    $className = $param->getClass()->name;
                    $result['args'][] = $this->get($className);
                }
            }
        }
        return $result;
    }

    private function getPreference($config, $interface)
    {
        foreach($config as $for => $type) {
            if($for == $interface) {
                return $type;
            }
        }
    }
}
