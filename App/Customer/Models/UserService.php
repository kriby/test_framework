<?php
namespace App\Customer\Models;

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
     * @throws \Exception
     */
    public function verify(string $password, string $hash)
    {
        if (password_verify($password, $hash)) {
            return true;
        } else {
            throw new \Exception('Invalid username/password. Check your credentials.');
        }
    }
}
