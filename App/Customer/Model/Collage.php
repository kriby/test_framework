<?php
namespace App\Customer\Model;

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Class Collage
 * @package App\Customer
 */
class Collage
{
    /**
     * Method draws a collage from friends avatars.
     *
     * @param $x
     * @param $y
     * @return resource
     * @throws \Exception
     */
    public function drawCollage($x, $y)
    {
        $username = 'k_riby';
        $friends = $this->getFriendsList($username);
        $posX = 0;
        $posY = 0;
        if(!isset($x) && !isset($y)) {
            throw new \Exception("height and width must be set!");
        }
        $collage = imagecreatetruecolor($x, $y);

        while ($posY <= $y) {
            foreach ($friends['users'] as $user) {
                $image = imagecreatefromstring(file_get_contents($user['profile_image_url']));
                imagecopymerge($collage, $image, $posX, $posY, 5, 5, 50, 50, 100);
                $posX+=50;
                if ($posX >= $x) {
                    $posY += 50;
                    $posX = 0;
                }
                if ($posX >= $x && $posY >= $y) {
                    break;
                }
            }
        }
        return $collage;
    }

    /**
     * Method sets connection with Twitter API using access token and application credentials.
     *
     * @return TwitterOAuth
     */
    private function setConnection()
    {
        $connection = new TwitterOAuth(
            CONSUMER_KEY,
            CONSUMER_SECRET,
            $_SESSION['access_token'],
            $_SESSION['access_token_secret']
        );
        $connection->setDecodeJsonAsArray(true);
        return $connection;
    }

    /**
     * Method returns friends list for specified twitter user.
     *
     * @param $username
     * @return array|object
     */
    private function getFriendsList($username)
    {
        $connection = $this->setConnection();
        return $connection->get("friends/list", ["screen_name" => $username]);
    }
}