<?php

/**
 * TinyMVC
 * 
 * PHP framework based on MVC architecture
 * 
 * @copyright 2019-2020 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/TinyMVC
 */

namespace Framework\ORM;

/**
 * Seeds
 * 
 * Manage database seeds
 */
class Seeder
{
    /**
     * insert data in table
     *
     * @param  string $table name of table
     * @param  array $data data to insert
     * @return void
     */
    public function insert(string $table, array $data): void
    {
        $QB = new QueryBuilder();
        $QB->insert($table, $data)->executeQuery();
    }
}