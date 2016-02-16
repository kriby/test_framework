<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 2/13/2016
 * Time: 20:28
 */

namespace App\Db;


interface QueryBuilderInterface
{
    /**
     * @param string $fields
     * @return QueryBuilderInterface
     */
    public function select($fields = '*');

    /**
     * @param $table
     * @return QueryBuilderInterface
     */
    public function from($table);

    /**
     * @param $attribute
     * @param $sign
     * @return QueryBuilderInterface
     */
    public function where($attribute, $sign);

    /**
     * @return array
     */
    public function getAll();

    /**
     * @return array
     */
    public function getRow();

    /**
     * @param array $params
     * @return QueryBuilderInterface
     */
    public function execute(array $params);

    /**
     * @param $table
     * @return QueryBuilderInterface
     */
    public function insert($table);

    /**
     * @param array $values
     * @return QueryBuilderInterface
     */
    public function values(array $values);

    /**
     * @param $attribute
     * @param $sign
     * @return QueryBuilderInterface
     */
    public function andWhere($attribute, $sign);

    /**
     * @param $name
     * @param $type
     * @param $size
     * @param array $options
     * @return QueryBuilderInterface
     */
    public function addColumn($name, $type, $size, $options = []);

    /**
     * @param string $dbname
     * @return QueryBuilderInterface
     */
    public function createDatabase($dbname);

    /**
     * @param string $table
     * @return QueryBuilderInterface
     */
    public function createTable($table);
}