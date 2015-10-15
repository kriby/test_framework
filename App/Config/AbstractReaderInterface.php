<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 09.10.2015
 * Time: 15:05
 */

namespace App\Config;


interface AbstractReaderInterface
{
    public function getPreference($for);
}