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
        $this->username = $request->getPost('username');
        $this->email = $request->getPost('email');
        $this->password = $request->getPost('password');
        $this->passwordConfirm = $request->getPost('confirm_password');

        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @return \PDOStatement|string
     * @throws \Exception
     */
    public function save()
    {
        $request = $this->queryBuilder->select()->from('users')->where('email', '=', $this->email)->execute();

        if ($request->getAll()) {
            return 'Such user already exists!';
        } else {
            $params = [
                'email' => $this->email,
                'user_name' => $this->username,
                'user_password' => $this->hashPassword()
            ];

            $request = $this->queryBuilder->insert('users')->values($params);
            if($request->execute()) {
                Session::set('user', $this->username);
            } else {
                throw new \Exception('Customer cannot be saved');
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
        $request = $this->queryBuilder
            ->select()
            ->from('users')
            ->where('email', '=', $this->email)
            ->andWhere('password', '=', $this->getPassword())
            ->execute();
        if (!$request->getAll()) {
            throw new \Exception('Invalid username/password. Check your credentials.');
        }
    }
}
