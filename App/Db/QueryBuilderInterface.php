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
     * @param $param
     * @param $sign
     * @param $value
     * @return QueryBuilderInterface
     */
    public function where($param, $sign, $value);

    public function getAll();

    /**
     * @return boolean
     */
    public function execute();

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

}