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
    /**
     * Data types.
     */
    const TYPE_BOOLEAN = 'boolean';

    const TYPE_SMALLINT = 'smallint';

    const TYPE_INTEGER = 'integer';

    const TYPE_BIGINT = 'bigint';

    const TYPE_FLOAT = 'float';

    const TYPE_NUMERIC = 'numeric';

    const TYPE_DECIMAL = 'decimal';

    const TYPE_DATE = 'date';

    const TYPE_TIMESTAMP = 'timestamp';

    const TYPE_DATETIME = 'datetime';

    const TYPE_CHAR = 'char';

    const TYPE_VARCHAR = 'varchar';

    const TYPE_TEXT = 'text';

    const TYPE_BLOB = 'blob';

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
     * @param $attribute
     * @param $sign
     * @return QueryBuilder
     */
    public function where($attribute, $sign)
    {
        $this->query .= "WHERE $attribute $sign :$attribute";
        return $this;
    }

    /**
     * @param $attribute
     * @param $sign
     * @return QueryBuilder
     */
    public function andWhere($attribute, $sign)
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
     * @param $name
     * @param $type
     * @param $size
     * @param array $options
     * @return QueryBuilder
     */
    public function addColumn($name, $type, $size, $options = [])
    {
        // TODO: Implement addColumn() method.
    }

    /**
     * @param string $dbname
     * @return QueryBuilder
     */
    public function createDatabase($dbname)
    {
        // TODO: Implement createDatabase() method.
    }

    /**
     * @param string $table
     * @return QueryBuilder
     */
    public function createTable($table)
    {
        // TODO: Implement createTable() method.
    }
}
