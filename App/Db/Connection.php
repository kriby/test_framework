<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12/20/2015
 * Time: 18:24
 */

namespace App\Db;

class Connection
{
    private static $instance;
    private $connection;

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return Connection
     */
    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance =  new self();
        }
        return self::$instance;
    }

    /**
     * Prevent cloning of the instance
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Connection constructor.
     */
    private function __construct()
    {
        $this->connection = $this->connect();
    }

    /**
     * @return \PDO
     */
    private function connect()
    {
        $dsn = Config::getDsn();
        $username = Config::getUsername();
        $password = Config::getPassword();
        try {
            return new \PDO($dsn, $username, $password);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}
