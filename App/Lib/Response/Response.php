<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 2/13/2016
 * Time: 19:47
 */

namespace App\Lib\Response;


class Response
{
        public function redirect($location)
        {
            header("Location: $location");
        }
}