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
    public function select(string $fields = '*');

    /**
     * @param string $table
     * @return QueryBuilderInterface
     */
    public function from(string $table);

    /**
     * @param string $attribute
     * @param string $sign
     * @return QueryBuilderInterface
     */
    public function where(string $attribute, string $sign);

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
     * @param string $table
     * @return QueryBuilderInterface
     */
    public function insert(string $table);

    /**
     * @param array $values
     * @return QueryBuilderInterface
     */
    public function values(array $values);

    /**
     * @param string $attribute
     * @param string $sign
     * @return QueryBuilderInterface
     */
    public function andWhere(string $attribute, string $sign);

    /**
     * @param string $dbname
     * @return QueryBuilderInterface
     */
    public function createDatabase(string $dbname);

    /**
     * @param $name
     * @param array $columns
     * @param array $options
     * @return QueryBuilderInterface
     */
    public function createTable(string $name, array $columns, array $options);

    /**
     * @param string $table
     * @param string|array $attribute
     * @return QueryBuilderInterface
     */
    public function addIndex(string $table, $attribute);

    /**
     * @param string $dbname
     * @return QueryBuilderInterface
     */
    public function useDatabase(string $dbname);
}
