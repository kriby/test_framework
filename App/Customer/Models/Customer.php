<?php
namespace App\Customer\Models;

use App\Db\QueryBuilderInterface;
use App\Lib\Request\RequestInterface;
use App\Lib\Session\Session;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Customer
{
    /**
     * @var QueryBuilderInterface
     */
    private $queryBuilder;
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->request->getPost('username');
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->request->getPost('email');
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->request->getPost('password');
    }

    /**
     * @return string
     */
    public function getPasswordConfirm()
    {
        return $this->request->getPost('confirm_password');
    }

    /**
     * Save constructor.
     *
     * @param RequestInterface $request
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(RequestInterface $request, QueryBuilderInterface $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
        $this->request = $request;
    }

    /**
     * @return \PDOStatement|string
     * @throws \Exception
     */
    public function save()
    {
        // create a log channel
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));

// add records to the log
        $log->warning('Foo');
        $log->error('Bar');


        $request = $this->queryBuilder
            ->select()
            ->from('users')
            ->where('email', '=')
            ->execute(['email' => $this->getEmail()]);

        if ($request->getAll()) {
            throw new \Exception('Such user already exists!');
        } else {
            $params = [
                'email' => $this->getEmail(),
                'user_name' => $this->getUsername(),
                'user_password' => $this->hashPassword()
            ];
            $request = $this->queryBuilder->insert('users')->values($params);
            if($request->execute($params)) {
                Session::set('user', $this->getUsername());
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
        return password_hash($this->getPassword(), PASSWORD_BCRYPT);
    }


    /**
     * @throws \Exception
     */
    public function find()
    {
        $params = [
            'email' => $this->getEmail(),
        ];
        $request = $this->queryBuilder
            ->select()
            ->from('users')
            ->where('email', '=')
            ->execute($params)
            ->getRow();
        if (password_verify($this->getPassword(),$request['user_password'])) {
            return $request;
        } else {
            throw new \Exception('Invalid username/password. Check your credentials.');
        }
    }
}
