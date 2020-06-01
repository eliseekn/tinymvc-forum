<?php

namespace App\Database\Migrations;

use Framework\ORM\Migration;

/**
 * TopicsTable
 * 
 * Migration of topics table
 */
class TopicsTable extends Migration
{    
    /**
     * create table
     *
     * @return void
     */
    public function migrate(): void
    {
        $this->table('topics')
            ->addPrimaryKey('id')
            ->addString('title')
            ->addString('slug')
            ->addText('content')
            ->addText('attachments')
            ->addInteger('user_id')
            ->addInteger('cat_id')
            ->addString('state', 255, false, false, 'open')
            ->addInteger('comments_count', 11, false, false, 0)
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
        $this->truncateTable('topics');
    }
    
    /**
     * drop table
     *
     * @return void
     */
    public function delete(): void
    {
        $this->dropTable('topics');
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