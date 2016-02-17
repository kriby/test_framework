<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 2/16/2016
 * Time: 22:42
 */
namespace App;

use App\Db\Config;
use App\Db\QueryBuilderInterface;

class Install
{
    /**
     * @var QueryBuilderInterface
     */
    private $queryBuilder;

    /**
     * Install constructor.
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(QueryBuilderInterface $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function install()
    {
        try {
            $this->queryBuilder
                ->createDatabase(Config::getDatabaseName())
                ->createTable(
                    'users',
                    [
                        'user_id' => 'smallint(6), NOT NULL AUTO_INCREMENT PRIMARY KEY',
                        'user_name, varchar(30), NOT NULL',
                        'email, varchar(30), NOT NULL',
                        'user_password, char(60), NOT NULL',
                    ],
                    [
                        'ENGINE=InnoDB',
                        'DEFAULT CHARSET=utf8'
                    ]
                );
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}