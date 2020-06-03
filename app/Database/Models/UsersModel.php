<?php

namespace App\Database\Models;

use Framework\ORM\Model;

/**
 * UsersModel
 * 
 * Users model class
 */
class UsersModel extends Model
{    
    /**
     * name of table
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * instantiates class
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct($this->table);
    }
    
    /**
     * get user row by email address
     *
     * @param  string $email
     * @return mixed
     */
    public function findEmail(string $email)
    {
        return $this->findSingle('email', '=', $email);
    }

    /**
     * checks if user is registered
     *
     * @param  string $email email address of user
     * @param  string $password user password
     * @return bool
     */
    public function isRegistered(string $email, string $password): bool
    {
        $user = $this->findEmail($email);
        return isset($user->password) ? compare_hash($password, $user->password) : false;
    }

    /**
     * checks if user is already registered
     *
     * @param  string $email email address of user
     * @return bool
     */
    public function isAlreadyRegistered(string $email): bool
    {
        $user = $this->findEmail($email);
        return isset($user->email);
    }
    
    /**
     * get total users topic
     *
     * @param  int $user_id
     * @return int
     */
    public function totalTopics(int $user_id): int
    {
        return $this->QB->select('*')
            ->from('topics')
            ->where('user_id', '=', $user_id)
            ->rowsCount();
    }
    
    /**
     * get total users comments
     *
     * @param  int $user_id
     * @return int
     */
    public function totalComments(int $user_id): int
    {
        return $this->QB->select('*')
            ->from('comments')
            ->where('user_id', '=', $user_id)
            ->rowsCount();
    }
    
    /**
     * get total users votes
     *
     * @param  int $user_id
     * @return int
     */
    public function totalVotes(int $user_id): int
    {
        return $this->QB->select('*')
            ->from('votes')
            ->where('user_id', '=', $user_id)
            ->rowsCount();
    }
}