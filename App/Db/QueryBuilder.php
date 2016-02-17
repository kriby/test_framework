<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 2/13/2016
 * Time: 20:49
 */
namespace App\Db;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class QueryBuilder implements QueryBuilderInterface
{
    private $query;
    private $connection;
    /** @var  \PDOStatement */
    private $preparedStatement;
    private $log;

    public function __construct()
    {
        $this->connection = Connection::getInstance()->getConnection();
        // create a log channel
        $this->log = new Logger('name');
        $this->log->pushHandler(new StreamHandler(ROOT . DS . 'error.log', Logger::WARNING));
    }

    /**
     * @param string $fields
     * @return QueryBuilder
     */
    public function select(string $fields = '*')
    {
        $this->query = "SELECT $fields ";
        return $this;
    }

    /**
     * @param string $table
     * @return QueryBuilder
     */
    public function from(string $table)
    {
        $this->query .= "FROM $table ";
        return $this;
    }

    /**
     * @param string $attribute
     * @param string $sign
     * @return QueryBuilder
     */
    public function where(string $attribute, string $sign)
    {
        $this->query .= "WHERE $attribute $sign :$attribute";
        return $this;
    }

    /**
     * @param string $attribute
     * @param string $sign
     * @return QueryBuilder
     */
    public function andWhere(string $attribute, string $sign)
    {
        $this->query .= " AND $attribute $sign :$attribute";
        return $this;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->preparedStatement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    public function getRow()
    {
        return $this->preparedStatement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param array $params
     * @return QueryBuilder
     */
    public function execute(array $params)
    {
        $this->preparedStatement = $this->connection->prepare($this->query);
        $this->preparedStatement->execute($params);
        return $this;
    }

    /**
     * @param string $table
     * @return QueryBuilder
     */
    public function insert(string $table)
    {
        $this->query = "INSERT INTO $table ";
        return $this;
    }

    /**
     * @param array $values
     * @return QueryBuilder
     */
    public function values(array $values)
    {
        $placeholders = [];
        $attributes = array_keys($values);
        foreach($attributes as $value) {
            $placeholders[] = ":{$value}";
        }
        $placeholders = implode(', ', $placeholders);
        $attributes = implode(', ', $attributes);

        $this->query .="($attributes) VALUES ($placeholders)";

        return $this;
    }

    /**
     * @param string $dbname
     * @return QueryBuilder
     */
    public function createDatabase(string $dbname)
    {
        $this->query = "CREATE DATABASE $dbname; use $dbname";
        $this->preparedStatement = $this->connection->prepare($this->query);
        $this->preparedStatement->execute();
        return $this;
    }

    /**
     * @param string|array $attribute
     * @return QueryBuilderInterface
     */
    public function addIndex($attribute)
    {
        // TODO: Implement addIndex() method.
    }

    /**
     * @param string $name
     * @param array $columns
     * @param array $options
     * @return QueryBuilderInterface
     */
    public function createTable(string $name, array $columns, array $options = [])
    {
        $this->query = sprintf('CREATE TABLE `%s`(', $name);
        foreach($columns as $key => &$value) {
            $value = sprintf('`%s` ', $key) . $value;
        }
        unset($value);
        $columns = implode(',', $columns);

        $this->query .= "$columns)";
        foreach($options as $key => &$value) {
            $value = "$key=$value";
        }
        unset($value);
        $options = implode(' ', $options);

        $this->query .= " $options";
        try {
            $this->preparedStatement = $this->connection->prepare($this->query);
            if ($this->preparedStatement->execute() === false) {
                throw new \PDOException("Database cannot be created.");
            }
        } catch (\Exception $e) {
            $this->log->error('Bar');
            echo $e->getMessage();
        }
    }
}
