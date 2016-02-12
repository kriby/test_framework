<?php
namespace App\Customer\Models;

use App\Db\Connection;
use App\Lib\Request\RequestObject;
use App\Lib\Session\Session;

class Customer
{
    public $username;
    public $email;
    public $password;
    public $passwordConfirm;

    /**
     * Save constructor.
     * @param RequestObject $requestObject
     */
    public function __construct(RequestObject $requestObject)
    {
        $this->connection = Connection ::getInstance()->getConnection();
        $this->username = $requestObject->getPost('user_name');
        $this->email = $requestObject->getPost('email');
        $this->password = $requestObject->getPost('password');
        $this->passwordConfirm = $requestObject->getPost('confirm_password');

    }

    /**
     * @param $password
     * @return null
     */
    public function getPassword()
    {
        return $this->hashPassword();
    }

    /**
     * @return \PDOStatement|string
     */
    public function save()
    {

        $username = $this->connection->quote($this->username);
        $email = $this->connection->quote($this->email);
        $password = $this->connection->quote($this->getPassword());
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
     * @return string
     */
    public function getCustomer()
    {
        $email = $this->connection->quote($this->email);
        $password = $this->connection->quote($this->getPassword());
        $request = $this->connection->prepare('SELECT * FROM users WHERE email = :email AND user_password = :password');
        $params = ['email' => $email, 'password' => $password];
        if ($request->execute($params)) {
            return 'You successfully logged in!';
        } else {
            return 'Check your credentials, please.';
        }
    }
}