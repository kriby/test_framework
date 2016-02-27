<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 2/27/2016
 * Time: 20:29
 */

namespace App\Customer\Models;


class UserVO
{
    private $email;
    private $user_name;
    private $user_password;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @param mixed $user_name
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }

    /**
     * @return mixed
     */
    public function getUserPassword()
    {
        return $this->user_password;
    }

    /**
     * @param mixed $user_password
     */
    public function setUserPassword($user_password)
    {
        $this->user_password = $user_password;
    }
}
