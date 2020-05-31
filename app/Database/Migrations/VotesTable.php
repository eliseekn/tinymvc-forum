<?php

namespace App\Database\Migrations;

use Framework\ORM\Migration;

/**
 * VotesTable
 * 
 * Migration of votes table
 */
class VotesTable extends Migration
{    
    /**
     * create table
     *
     * @return void
     */
    public function migrate(): void
    {
        $this->table('votes')
            ->addPrimaryKey('id')
            ->addString('user_id')
            ->addString('comment_id')
            ->create();
    }
    
    /**
     * truncate table
     *
     * @return void
     */
    public function clear(): void
    {
        $this->truncateTable('votes');
    }
    
    /**
     * drop table
     *
     * @return void
     */
    public function delete(): void
    {
        $this->dropTable('votes');
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