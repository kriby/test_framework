<?php
namespace App\Customer\Models;

use App\Db\Connection;
use App\Lib\Session\Session;

class Customer
{
    /**
     * @param $password
     * @return null
     */
    public function getPassword($password)
    {
        return $this->hashPassword($password);
    }

    /**
     * Save constructor.
     */
    public function __construct()
    {
        $this->connection = Connection ::getInstance()->getConnection();
    }

    /**
     * @param $username
     * @param $email
     * @param $password
     * @param $passwordConfirm
     * @return \PDOStatement|string
     */
    public function saveCustomer($username, $email, $password, $passwordConfirm)
    {
        if ($this->validate($password, $passwordConfirm)) {
            $username = $this->connection->quote($username);
            $email = $this->connection->quote($email);
            $password = $this->connection->quote($this->getPassword($password));
            $res = $this->connection->query("SELECT * FROM users WHERE email = {$email}");
            if ($res) {
                return 'Such user already exists!';
            } else {
                $result = $this->connection->query(
                    "INSERT INTO users (user_name, email, user_password) VALUES ({$username}, {$email},{$password})"
                );
                if ($result) {
                    Session::set('user', $username);
                }
            }
        }
    }

    /**
     * Validates user input.
     *
     * @param $password
     * @param $passwordConfirm
     * @return bool
     */
    private function validate($password, $passwordConfirm)
    {
        return $password == $passwordConfirm;
    }

    /**
     * @param $password
     * @return bool|string
     */
    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param $email
     * @param $password
     * @return string
     */
    public function getCustomer($email, $password)
    {
        $email = $this->connection->quote($email);
        $password = $this->connection->quote($this->getPassword($password));
        $res = $this->connection->query("SELECT * FROM users WHERE email = {$email} AND user_password = {$password}");
        if ($res) {
            return 'You successfully logged in!';
        } else {
            return 'Check your credentials, please.';
        }
    }
}