<?php

namespace App\Database\Models;

use Framework\ORM\Model;

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
            'users.role AS author_role',
            'categories.name AS cat_name'
        )
            ->from($this->table)
            ->innerJoin('users', "topics.user_id", 'users.id')
            ->innerJoin('categories', 'topics.cat_id', 'categories.id')
            ->where('topics.slug', '=', $slug)
            ->getQuery();

        return $this->findSingleQuery($query, [$slug]);
    }

    /**
     * generate custom pagination
     *
     * @param  string $cat_slug slug of category
     * @param  int $items_per_pages
     * @return mixed returns new paginator class
     */
    public function paginateTopicsAll(int $items_per_pages)
    {
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
            'users.role AS author_role',
            'categories.name AS cat_name'
        )
            ->from($this->table)
            ->innerJoin('users', 'topics.user_id', 'users.id')
            ->innerJoin('categories', 'topics.cat_id', 'categories.id')
            ->orderBy('topics.id', 'DESC')
            ->limit($pagination['first_item'], $items_per_pages)
            ->fetchAll();

        return $this->paginateQuery($items, $pagination);
    }

    /**
     * generate custom pagination
     *
     * @param  string $cat_slug slug of category
     * @param  int $items_per_pages
     * @return mixed returns new paginator class
     */
    public function paginateTopics(int $cat_id, int $items_per_pages)
    {
        $page = empty($this->request->getQuery('page')) ? 1 : (int) $this->request->getQuery('page');

        $total_items = $this->QB->select('*')
            ->from($this->table)
            ->where('cat_id', '=', $cat_id)
            ->rowsCount();

        $pagination = generate_pagination($page, $total_items, $items_per_pages);

        $items = $this->QB->select(
            'topics.*',
            'users.name AS author',
            'users.department AS author_department',
            'users.grade AS author_grade',
            'users.role AS author_role',
            'categories.name AS cat_name'
        )
            ->from($this->table)
            ->innerJoin('users', 'topics.user_id', 'users.id')
            ->innerJoin('categories', 'topics.cat_id', 'categories.id')
            ->where('cat_id', '=', $cat_id)
            ->orderBy('topics.id', 'DESC')
            ->limit($pagination['first_item'], $items_per_pages)
            ->fetchAll();

        return $this->paginateQuery($items, $pagination);
    }

    /**
     * generate custom search pagination
     *
     * @param  int $items_per_pages
     * @return mixed returns new paginator class
     */
    public function paginateTopicsSearch(int $items_per_pages)
    {
        $page = empty($this->request->getQuery('page')) ? 1 : $this->request->getQuery('page');
        $search_query = empty($this->request->getQuery('q')) ? '' : $this->request->getQuery('q');

        if (empty($search_query)) {
            return;
        }

        $total_items = $this->QB->select('*')
            ->from($this->table)
            ->like('title', $search_query)
            ->rowsCount();

        $pagination = generate_pagination($page, $total_items, $items_per_pages);

        $items = $this->QB->select(
            'topics.*',
            'users.name AS author',
            'users.department AS author_department',
            'users.grade AS author_grade',
            'users.role AS author_role',
            'categories.name AS cat_name'
        )
            ->from($this->table)
            ->innerJoin('users', 'topics.user_id', 'users.id')
            ->innerJoin('categories', 'topics.cat_id', 'categories.id')
            ->like('topics.title', $search_query)
            ->orderBy('topics.id', 'DESC')
            ->limit($pagination['first_item'], $items_per_pages)
            ->fetchAll();

        return $this->paginateQuery($items, $pagination);
    }
    
    /**
     * increment comments count
     *
     * @param  int $topic_id
     * @return void
     */
    public function incCommentsCount(int $topic_id): void
    {
        $topic = $this->find($topic_id);
        $comments_count = $topic->comments_count;
        $comments_count++;

        $this->setData([
            'comments_count' => $comments_count
        ])->update($topic_id);
    }
    
    /**
     * decrement comments count
     *
     * @param  int $topic_id
     * @return void
     */
    public function decCommentsCount(int $topic_id): void
    {
        $topic = $this->find($topic_id);
        $comments_count = $topic->comments_count;
        $comments_count--;

        $this->setData([
            'comments_count' => $comments_count
        ])->update($topic_id);
    }

    public function deleteTopicComments(int $topic_id)
    {
        /* $this->QB->deleteFrom($this->table)
            ->; */
    }
}