<?php
namespace App\Customer\Models;

use App\Db\Connection;

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
     * @param $email
     * @param $password
     * @param $passwordConfirm
     * @return \PDOStatement|string
     */
    public function saveCustomer($email, $password, $passwordConfirm)
    {
        if ($this->validate($password, $passwordConfirm)) {
            $email = $this->connection->quote($email);
            $password = $this->connection->quote($this->getPassword($password));
            $res = $this->connection->query("SELECT * FROM users WHERE email = {$email}");
            if ($res) {
                return 'Such user already exists!';
            } else {
                return $this->connection->query(
                    "INSERT INTO users (email, user_password) VALUES ({$email},{$password})"
                );
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