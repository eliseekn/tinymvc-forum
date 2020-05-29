<?php

namespace App\Database\Migrations;

use Framework\ORM\Migration;

/**
 * UsersTable
 * 
 * Migration of users table
 */
class UsersTable extends Migration
{    
    /**
     * create table
     *
     * @return void
     */
    public function migrate(): void
    {
        $this->table('users')
            ->addPrimaryKey('id')
            ->addString('name')
            ->addString('email')
            ->addString('password')
            ->addString('gender')
            ->addString('department')
            ->addString('grade')
            ->addString('role', 255, false, false, 'Utilisateur')
            ->addTimestamp('created_at')
            ->addTimestamp('updated_at')
            ->create();
    }
    
    /**
     * truncate table
     *
     * @return void
     */
    public function clear(): void
    {
        $this->truncateTable('users');
    }
    
    /**
     * drop table
     *
     * @return void
     */
    public function delete(): void
    {
        $this->dropTable('users');
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