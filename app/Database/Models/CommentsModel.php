<?php

namespace App\Database\Models;

use Framework\ORM\Model;

/**
 * CommentsModel
 * 
 * Comments model class
 */
class CommentsModel extends Model
{    
    /**
     * name of table
     *
     * @var string
     */
    protected $table = 'comments';

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
     * get row
     *
     * @param  int $topic_id
     * @return mixed
     */
    public function get(int $topic_id)
    {
        $query = $this->QB->select(
            'comments.*',
            'users.name AS author',
            'users.department AS author_department',
            'users.grade AS author_grade',
            'users.role AS author_role'
        )
            ->from('comments')
            ->innerJoin('users', 'comments.user_id', 'users.id')
            ->where('topic_id', '=', '?')
            ->orderBy('comments.id', 'DESC')
            ->getQuery();

        return $this->findAllQuery($query, [$topic_id]);
    }
    
    /**
     * get highest comment votes on topic
     *
     * @param  int $topic_id
     * @return mixed
     */
    public function highestVote(int $topic_id)
    {
        $query = $this->QB->select(
            'MAX(comments.votes) AS votes',
            'users.name AS author'
        )
            ->from('comments')
            ->innerJoin('users', 'comments.user_id', 'users.id')
            ->where('topic_id', '=', '?')
            ->groupBy('comments.id')
            ->getQuery();

        return $this->findSingleQuery($query, [$topic_id]);
    }

    /**
     * generate custom pagination
     *
     * @param  int $items_per_pages
     * @return mixed returns new paginator class
     */
    public function paginateComments(int $topic_id, int $items_per_pages)
    {
        $page = empty($this->request->getQuery('page')) ? 1 : (int) $this->request->getQuery('page');

        $total_items = $this->QB->select('*')
            ->from($this->table)
            ->where('topic_id', '=', $topic_id)
            ->rowsCount();

        $pagination = generate_pagination($page, $total_items, $items_per_pages);

        $items = $this->QB->select(
            'comments.*',
            'users.name AS author',
            'users.department AS author_department',
            'users.grade AS author_grade',
            'users.role AS author_role'
        )
            ->from('comments')
            ->innerJoin('users', 'comments.user_id', 'users.id')
            ->where('topic_id', '=', $topic_id)
            ->orderBy('comments.id', 'DESC')
            ->limit($pagination['first_item'], $items_per_pages)
            ->fetchAll();

        return $this->paginateQuery($items, $pagination);
    }

    /**
     * generate custom pagination
     *
     * @param  int $items_per_pages
     * @return mixed returns new paginator class
     */
    public function paginateAllComments(int $items_per_pages)
    {
        $page = empty($this->request->getQuery('page')) ? 1 : (int) $this->request->getQuery('page');

        $total_items = $this->QB->select('*')
            ->from($this->table)
            ->rowsCount();

        $pagination = generate_pagination($page, $total_items, $items_per_pages);

        $items = $this->QB->select(
            'comments.*',
            'topics.title AS topic_title',
            'topics.slug AS topic_slug',
            'users.id AS author_id',
            'users.name AS author',
            'users.department AS author_department',
            'users.grade AS author_grade',
            'users.role AS author_role'
        )
            ->from('comments')
            ->innerJoin('topics', 'comments.topic_id', 'topics.id')
            ->innerJoin('users', 'comments.user_id', 'users.id')
            ->orderBy('comments.id', 'DESC')
            ->limit($pagination['first_item'], $items_per_pages)
            ->fetchAll();

        return $this->paginateQuery($items, $pagination);
    }
    
    /**
     * increment votes
     *
     * @param  int $comment_id
     * @return void
     */
    public function incVotes(int $comment_id): void
    {
        $comment = $this->find($comment_id);
        $votes = $comment->votes;
        $votes++;

        $this->setData([
            'votes' => $votes
        ])->update($comment_id);
    }
    
    /**
     * decrement votes
     *
     * @param  int $comment_id
     * @return void
     */
    public function decVotes(int $comment_id): void
    {
        $comment = $this->find($comment_id);
        $votes = $comment->votes;
        $votes--;

        $this->setData([
            'votes' => $votes
        ])->update($comment_id);
    }
}
