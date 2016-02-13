<?php
namespace App\Customer\Models;

use App\Db\QueryBuilderInterface;
use App\Lib\Request\RequestInterface;
use App\Lib\Session\Session;

class Customer
{
    private $username;
    private $email;
    private $password;
    private $passwordConfirm;
    /**
     * @var QueryBuilderInterface
     */
    private $queryBuilder;

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
     * @param RequestInterface $request
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(RequestInterface $request, QueryBuilderInterface $queryBuilder)
    {
        $this->username = $request->getPost('user_name');
        $this->email = $request->getPost('email');
        $this->password = $request->getPost('password');
        $this->passwordConfirm = $request->getPost('confirm_password');

        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @return \PDOStatement|string
     */
    public function save()
    {
//        $params = ['email' => $email];
//        $request = $this->connection->prepare('SELECT * FROM users WHERE email = :email');
//        $result = $request->execute($params);

        $request = $this->queryBuilder->select()->from('users')->where('email', '=', $this->email);

        if ($request->execute()) {
            return 'Such user already exists!';
        } else {
            $params = [
                'email' => $this->email,
                'username' => $this->username,
                'password' => $this->hashPassword()
            ];
//            $request = $this->connection->prepare(
//                'INSERT INTO users (user_name, email, user_password) VALUES (:username, :email, :password)'
//            );

            $request = $this->queryBuilder->insert('users')->values($params);
            try {
                $request->execute();
                Session::set('user', $this->username);
            } catch (\PDOException $e) {
                echo $e->getMessage();
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
