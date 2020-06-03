<?php

namespace App\Database\Models;

use Framework\ORM\Model;

/**
 * CategoriesModel
 * 
 * Categories model class
 */
class CategoriesModel extends Model
{    
    /**
     * name of table
     *
     * @var string
     */
    protected $table = 'categories';

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
     * get single category row by slug
     *
     * @param  string $slug
     * @return mixed
     */
    public function findSlug(string $slug)
    {
        return $this->findSingle('slug', '=', $slug);
    }
    
    /**
     * increment topics count
     *
     * @param  int $cat_id
     * @return void
     */
    public function incTopicsCount(int $cat_id): void
    {
        $category = $this->find($cat_id);
        $topics_count = $category->topics_count;
        $topics_count++;

        $this->setData([
            'topics_count' => $topics_count
        ])->update($cat_id);
    }
    
    /**
     * decrement topics count
     *
     * @param  int $cat_id
     * @return void
     */
    public function decTopicsCount(int $cat_id): void
    {
        $category = $this->find($cat_id);
        $topics_count = $category->topics_count;
        $topics_count--;

        $this->setData([
            'topics_count' => $topics_count
        ])->update($cat_id);
    }
}
