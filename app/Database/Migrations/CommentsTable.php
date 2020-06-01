<?php

namespace App\Database\Migrations;

use Framework\ORM\Migration;

/**
 * CommentsTable
 * 
 * Migration of comments table
 */
class CommentsTable extends Migration
{    
    /**
     * create table
     *
     * @return void
     */
    public function migrate(): void
    {
        $this->table('comments')
            ->addPrimaryKey('id')
            ->addInteger('user_id')
            ->addInteger('topic_id')
            ->addText('content')
            ->addText('attachments')
            ->addInteger('votes', 11, false, false, 0)
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
        $this->truncateTable('comments');
    }
    
    /**
     * drop table
     *
     * @return void
     */
    public function delete(): void
    {
        $this->dropTable('comments');
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