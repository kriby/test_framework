<?php
namespace App\Customer\Model;

use Abraham\TwitterOAuth\TwitterOAuth;

class Authorization
{
    public function authorize()
    {
        date_default_timezone_set("Europe/Kiev");
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

        setcookie('oauth_token', $request_token['oauth_token']);
        setcookie('oauth_token_secret', $request_token['oauth_token_secret']);

        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        header("Location: $url");
    }

    public function getAccessToken()
    {
        if (isset($_SESSION['access_token']) && isset($_SESSION['access_token_secret'])) {
            $access_token['oauth_token'] = $_SESSION['access_token'];
            $access_token['oauth_token_secret'] = $_SESSION['access_token_secret'];
        } else {
            $connection = new TwitterOAuth(
                CONSUMER_KEY, CONSUMER_SECRET, $_COOKIE['oauth_token'], $_COOKIE['oauth_token_secret']
            );
            $access_token =
                $connection->oauth('oauth/access_token', array('oauth_verifier' => $_GET['oauth_verifier']));
            $_SESSION['access_token'] = $access_token['oauth_token'];
            $_SESSION['access_token_secret'] = $access_token['oauth_token_secret'];
        }
    }
}