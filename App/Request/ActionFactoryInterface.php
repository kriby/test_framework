<?php

namespace App\Request;


interface ActionFactoryInterface
{
    public function create($name);
}