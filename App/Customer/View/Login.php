<?php
namespace App\Customer\View;

class Login
{
    /**
     * Method renders a Login button
     * @param $collage
     */
    public function render()
    {
        echo <<<LOGIN
<a href="authorize">
    <img src="https://g.twimg.com/dev/sites/default/files/images_documentation/sign-in-with-twitter-gray.png"/>
</a>
LOGIN;
    }
}
