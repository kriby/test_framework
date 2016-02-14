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
    private $params;
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
    public function select($fields = '*')
    {
        $this->query = "SELECT $fields ";
        return $this;
    }

    /**
     * @param $table
     * @return QueryBuilder
     */
    public function from($table)
    {
        $this->query .= "FROM $table ";
        return $this;
    }

    /**
     * @param $param
     * @param $sign
     * @param $value
     * @return QueryBuilder
     */
    public function where($param, $sign, $value)
    {
        $this->params = [$param => $value];
        $this->query .= "WHERE $param $sign :$param";
        return $this;
    }

    /**
     * @param $param
     * @param $sign
     * @param $value
     * @return QueryBuilder
     */
    public function andWhere($param, $sign, $value)
    {
        $this->params = [$param => $value];
        $this->query .= " AND WHERE $param $sign :$param";
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
     * @return QueryBuilder
     */
    public function execute()
    {
        $this->preparedStatement = $this->connection->prepare($this->query);
        $this->preparedStatement->execute($this->params);
        return $this;
    }

    /**
     * @param $table
     * @return QueryBuilder
     */
    public function insert($table)
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
        $this->params = $values;
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
}
