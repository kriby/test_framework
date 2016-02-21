<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 2/13/2016
 * Time: 20:49
 */
namespace App\Db;

class QueryBuilder implements QueryBuilderInterface
{
    private $query;
    private $connection;
    /** @var  \PDOStatement */
    private $preparedStatement;

    public function __construct()
    {
        $this->connection = Connection::getInstance()->getConnection();
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
        $this->query = "CREATE DATABASE $dbname";
        $this->preparedStatement = $this->connection->prepare($this->query);
        $this->preparedStatement->execute();
        return $this;
    }

    /**
     * @param string $table
     * @param string|array $attribute
     * @return QueryBuilderInterface
     */
    public function addIndex(string $table, $attribute)
    {
        $this->query = sprintf('ALTER TABLE `%s` ', $table) . "ADD INDEX(`$attribute`)";
        $this->preparedStatement = $this->connection->prepare($this->query);
        $this->preparedStatement->execute();
    }

    /**
     * @param string $name
     * @param array $columns
     * @param array $options
     * @return QueryBuilderInterface
     */
    public function createTable(string $name, array $columns, array $options = [])
    {
        $this->query = sprintf('CREATE TABLE IF NOT EXISTS `%s`(', $name);
        foreach($columns as $key => &$value) {
            $value = sprintf('`%s` ', $key) . $value;
        }
        unset($value);
        $columns = implode(',', $columns);

        $this->query .= "$columns)";

        $options = implode(' ', $options);
        $this->query .= " $options";
        $this->preparedStatement = $this->connection->prepare($this->query);
        if ($this->preparedStatement->execute() === false) {
            throw new \PDOException("Database cannot be created.");
        }
        return $this;
    }

    /**
     * @param string $dbname
     * @return QueryBuilderInterface
     */
    public function useDatabase(string $dbname)
    {
        $this->query = "USE $dbname";
        $this->preparedStatement = $this->connection->prepare($this->query);
        $this->preparedStatement->execute();
        return $this;
    }
}
