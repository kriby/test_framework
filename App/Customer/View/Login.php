<?php
namespace App\Customer\View;

class Login
{
    /**
     * Method renders a Login button if Customer is not logged in already
     */
    public function render()
    {
        if(isset($_SESSION['access_token']) && isset($_SESSION['access_token_secret'])) {
            header("Location: customer/home");
        }
        echo <<<LOGIN
<a href="http://rl.dev/test_framework/customer/authorize">
    <img src="https://g.twimg.com/dev/sites/default/files/images_documentation/sign-in-with-twitter-gray.png"/>
</a>
LOGIN;
    }
}
