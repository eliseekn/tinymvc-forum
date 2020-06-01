<?php

namespace App\Database\Migrations;

use Framework\ORM\Migration;

/**
 * CategoriesTable
 * 
 * Migration of categories table
 */
class CategoriesTable extends Migration
{    
    /**
     * create table
     *
     * @return void
     */
    public function migrate(): void
    {
        $this->table('categories')
            ->addPrimaryKey('id')
            ->addString('name')
            ->addString('slug')
            ->addString('description')
            ->addInteger('topics_count', 11, false, false, 0)
            ->addTimestamp('created_at')
            ->addTimestamp('updated_at')
            ->create();
    }
    
    /**
     * truncate table
     *
     * @return void
     */
    public function empty(): void
    {
        $this->truncateTable('categories');
    }
    
    /**
     * drop table
     *
     * @return void
     */
    public function delete(): void
    {
        $this->dropTable('categories');
    }
    
    /**
     * roll back actions
     *
     * @return void
     */
    public function rollBack(): void
    {
        $this->delete();
        $this->migrate();
    }
}