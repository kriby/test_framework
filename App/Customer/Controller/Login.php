<?php
namespace App\Customer\Controller;

use App\Customer\View\Login as LoginView;

class Login
{
    public function execute()
    {
        $view = new LoginView();
        $view->render();
    }
}