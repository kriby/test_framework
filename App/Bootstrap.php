<?php
namespace App;

class Bootstrap
{
    public function createApplication($applicationName)
    {
        $container = new Container();
        return $container->create($applicationName);
    }

}