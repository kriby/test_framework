<?php
namespace App\Customer\Controller;

use \App\Customer\View\Home as HomeView;

class Home
{
    public function execute()
    {
        if (!isset($_SESSION['access_token']) && !isset($_SESSION['access_token_secret'])) {
            header("Location: customer/login");
        }
        $homeView = new HomeView();
        $homeView->render();
    }
}