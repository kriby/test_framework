<?php
namespace App\Customer\Models;

use App\Db\Connection;
use App\Lib\Request\Request;
use App\Lib\Session\Session;

class Customer
{
    private $username;
    private $email;
    private $password;
    private $passwordConfirm;

    /**
     * @return array|string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return array|string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return array|string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return array|string
     */
    public function getPasswordConfirm()
    {
        return $this->passwordConfirm;
    }

    /**
     * Save constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->connection = Connection ::getInstance()->getConnection();
        $this->username = $request->getPost('user_name');
        $this->email = $request->getPost('email');
        $this->password = $request->getPost('password');
        $this->passwordConfirm = $request->getPost('confirm_password');

    }

    /**
     * @return \PDOStatement|string
     */
    public function save()
    {

        $username = $this->connection->quote($this->username);
        $email = $this->connection->quote($this->email);
        $password = $this->connection->quote($this->hashPassword());
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
            try {
                $result = $request->execute($params);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
            if ($result) {
                Session::set('user', $username);
            }
        }
    }

    /**
     * @return bool|string
     */
    private function hashPassword()
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }


    /**
     * @throws \Exception
     */
    public function getCustomer()
    {
        $email = $this->connection->quote($this->email);
        $password = $this->connection->quote($this->getPassword());
        $request = $this->connection->prepare('SELECT * FROM users WHERE email = :email AND user_password = :password');
        $params = ['email' => $email, 'password' => $password];
        if (!$request->execute($params)) {
            throw new \Exception('Invalid username/password. Check your credentials.');
        }
    }
}
