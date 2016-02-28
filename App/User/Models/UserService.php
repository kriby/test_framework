<?php
namespace App\User\Models;

class UserService
{
    /**
     * @param string $password
     * @return bool|string
     */
    public function hashPassword(string $password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function verify(string $password, string $hash)
    {
        return password_verify($password, $hash);
    }
}
