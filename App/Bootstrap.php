<?php
namespace App;

class Bootstrap
{
    public function createApplication($applicationName)
    {
        $oiC = new Container();
        return $oiC->create($applicationName);
    }

}