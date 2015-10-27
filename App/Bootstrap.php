<?php
namespace App;

use App\Config\Config;
use App\Config\DiConverter;
use App\Config\XmlReader;

class Bootstrap
{
    public function createApplication($applicationName)
    {
        $config = new Config(new XmlReader(), new DiConverter());
        $container = new Container($config);
        return $container->create($applicationName);
    }
}
