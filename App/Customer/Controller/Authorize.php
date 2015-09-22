<?php
namespace App\Customer\Controller;

use App\Customer\Model\Authorization;

class Authorize
{
    public function execute()
    {
        $authorization = new Authorization();
        $authorization->authorize();
    }
}