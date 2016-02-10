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
            $params = ['email' => $email];
            $request = $this->connection->prepare('SELECT * FROM users WHERE email = :email');
            $result = $request->execute($params);
            if ($result) {
                return 'Such user already exists!';
            } else {
                $params = ['email' => $email, 'username' => $username, 'password' => $password];
                $request = $this->connection->prepare(
                    'INSERT INTO users (user_name, email, user_password) VALUES (:username, :email, :password)'
                );
                $result = $request->execute($params);
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
        $request = $this->connection->prepare('SELECT * FROM users WHERE email = :email AND user_password = :password');
        $params = ['email' => $email, 'password' => $password];
        if ($request->execute($params)) {
            return 'You successfully logged in!';
        } else {
            return 'Check your credentials, please.';
        }
    }
}