<?php

namespace App\Database\Models;

use Framework\ORM\Model;
use Framework\ORM\QueryBuilder;

/**
 * TopicsModel
 * 
 * Topics model class
 */
class TopicsModel extends Model
{    
    /**
     * name of table
     *
     * @var string
     */
    protected $table = 'topics';

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
     * @param  string $slug
     * @return mixed returns new paginator class
     */
    public function get(string $slug)
    {
        $query = $this->QB->select(
            'topics.*',
            'users.name AS author',
            'users.department AS author_department',
            'users.grade AS author_grade',
            'users.role AS author_role'
        )
            ->from('topics')
            ->innerJoin('users', 'topics.user_id', 'users.id')
            ->where('slug', '=', $slug)
            ->getQuery();

        return $this->findSingleQuery($query, [$slug]);
    }

    /**
     * generate custom pagination
     *
     * @param  int $items_per_pages
     * @return mixed returns new paginator class
     */
    public function paginateTopics(int $items_per_pages) {
        $page = empty($this->request->getQuery('page')) ? 1 : (int) $this->request->getQuery('page');

        $total_items = $this->QB->select('*')
            ->from($this->table)
            ->rowsCount();

        $pagination = generate_pagination($page, $total_items, $items_per_pages);

        $items = $this->QB->select(
            'topics.*',
            'users.name AS author',
            'users.department AS author_department',
            'users.grade AS author_grade',
            'users.role AS author_role'
        )
            ->from('topics')
            ->innerJoin('users', 'topics.user_id', 'users.id')
            ->orderBy('topics.id', 'DESC')
            ->limit($pagination['first_item'], $items_per_pages)
            ->fetchAll();

        return $this->paginateQuery($items, $pagination);
    }
}