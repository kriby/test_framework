<?php
namespace App\Customer\Models;

use App\Db\Config;
use App\Db\QueryBuilderInterface;

class User
{
    const TABLE = 'users';

    public $email;
    public $username;
    public $password;
    public $password_confirm;
    /**
     * @var QueryBuilderInterface
     */
    private $queryBuilder;

    /**
     * Save constructor.
     *
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(QueryBuilderInterface $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @return \PDOStatement|string
     * @throws \Exception
     */
    public function save()
    {
        $params = [
            'email' => $this->email,
            'user_name' => $this->username,
            'user_password' => $this->hashPassword()
        ];
        $request = $this->queryBuilder->insert(self::TABLE)->values($params);
        if (!$request->execute($params)) {
            throw new \Exception('Customer cannot be saved');
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
     * @param string $attribute
     * @param string $value
     * @return array
     * @throws \Exception
     */
    public function findBy(string $attribute, string $value)
    {
        $params = [
//            'email' => $this->getEmail(),
            $attribute => $value,
        ];
        $user = $this->queryBuilder
            ->useDatabase(Config::getDatabaseName())
            ->select()
            ->from(self::TABLE)
            ->where($attribute, '=')
            ->execute($params)
            ->getRow();

        return $user;
    }

    /**
     * @param array $user
     * @return bool
     * @throws \Exception
     */
    public function verify(array $user)
    {
        if (password_verify($this->password,$user['user_password'])) {
        } else {
            throw new \Exception('Invalid username/password. Check your credentials.');
        }
    }
}
