<?php
namespace App\Customer\Models;

use App\Db\Connection;

class Save
{
    private $email;
    private $password;
    private $passwordConfirm;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

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
        $this->connection = Connection ::getInstance();
    }

    /**
     * @param $email
     * @param $password
     * @param $passwordConfirm
     * @return \PDOStatement|string
     */
    public function saveCustomer($email, $password, $passwordConfirm)
    {
        if($this->validate($password, $passwordConfirm)) {
            $db = $this->connection->getConnection();
            $email = $db->quote($email);
            $password = $db->quote($this->getPassword($password));
            $res = $db->query("SELECT * FROM users WHERE email = {$email}");
            if ($res) {
                return 'Such user already exists!';
            } else {
                return $db->query("INSERT INTO users (email, user_password) VALUES ({$email},{$password})");
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
}