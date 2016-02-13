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
    private $statement;
    private $connection;
    private $params;

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
        $this->statement = "SELECT $fields ";
        return $this;
    }

    /**
     * @param $table
     * @return QueryBuilder
     */
    public function from($table)
    {
        $this->statement .= "FROM $table ";
        return $this;
    }

    public function where($param, $sign, $value)
    {
        $this->params = [$param => $value];
        $this->statement .= "WHERE $param $sign :$param";
        return $this;
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function execute()
    {
        $preparedStatement = $this->connection->prepare($this->statement);
        $preparedStatement->execute($this->params);
    }

    public function insert($table)
    {
        $this->statement = "INSERT INTO $table ";
        return $this;
    }


    public function values(array $values)
    {
        $this->params = $values;
        $placeholders = [];
        foreach(array_keys($values) as $value) {
            $placeholders[] = ":{$value}";
        }
        $placeholders = implode(',', $placeholders);
        $attributes = implode(',', $values);

        $this->statement .="($attributes) VALUES ($placeholders)";

        return $this;
    }
}
