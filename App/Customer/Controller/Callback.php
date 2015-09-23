<?php
namespace App\Customer\Controller;

use App\Customer\Model\Authorization;

class Callback
{
    public function execute()
    {
        $authorization = new Authorization();
        $authorization->getAccessToken();
        header("Location: home");
    }
}