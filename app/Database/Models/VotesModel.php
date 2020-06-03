<?php

namespace App\Database\Models;

use Framework\ORM\Model;

/**
 * VotesModel
 * 
 * Votes model class
 */
class VotesModel extends Model
{    
    /**
     * name of table
     *
     * @var string
     */
    protected $table = 'votes';

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
     * get voter row
     *
     * @param  int $user_id
     * @param  int $comment_id
     * @return array
     */
    public function findVoter(int $user_id, int $comment_id): array
    {
        return $this->QB->select('*')
            ->from($this->table)
            ->where('user_id', '=', $user_id)
            ->and('comment_id', '=', $comment_id)
            ->fetchSingle();
    }
    
    /**
     * dissmiss comment vote
     *
     * @param  int $user_id
     * @param  int $comment_id
     * @return void
     */
    public function dismissVote(int $user_id, int $comment_id): void
    {
        $this->QB->deleteFrom($this->table)
            ->where('user_id', '=', $user_id)
            ->and('comment_id', '=', $comment_id)
            ->limit(1)
            ->executeQuery();
    }
}
