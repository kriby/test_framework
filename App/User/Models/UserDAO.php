<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 2/27/2016
 * Time: 20:31
 */

namespace App\User\Models;

use App\Db\Config;
use App\Db\QueryBuilderInterface;

class UserDAO
{
    const TABLE = 'users';

    /**
     * @var QueryBuilderInterface
     */
    private $queryBuilder;

    /**
     * UserDAO constructor.
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(QueryBuilderInterface $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    protected function getAllUsers()
    {

    }

    /**
     * Retrieves the corresponding row for the specified user email.
     *
     * @param string $userEmail
     * @return UserVO
     */
    public function getByUserEmail(string $userEmail)
    {
        return $this->findBy('email', $userEmail);
    }

    /**
     * @param string $attribute
     * @param string $value
     * @return UserVO
     * @throws \Exception
     */
    public function findBy(string $attribute, string $value)
    {
        $params = [
            $attribute => $value,
        ];
        $row = $this->queryBuilder
            ->useDatabase(Config::getDatabaseName())
            ->select()
            ->from(self::TABLE)
            ->where($attribute, '=')
            ->execute($params)
            ->getRow();
        $userVO = new UserVO();
        $userVO->setEmail($row['email']);
        $userVO->setUserName($row['user_name']);
        $userVO->setUserPassword($row['user_password']);
        return $userVO;
    }

    /**
     * Saves the supplied user to the database
     *
     * @param UserVO $userVO
     * @throws \Exception
     */
    public function save(UserVO $userVO)
    {
        $params = [
            'email' => $userVO->getEmail(),
            'user_name' => $userVO->getUserName(),
            'user_password' => $userVO->getUserPassword()
        ];
        $request = $this->queryBuilder->insert(self::TABLE)->values($params);
        if (!$request->execute($params)) {
            throw new \Exception('User cannot be saved');
        }
    }

    // Deletes the supplied user from the database.
    public function delete($userVO)
    {
    }
}
