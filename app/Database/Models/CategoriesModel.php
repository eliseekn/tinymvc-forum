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
     * get row
     *
     * @param  int $topic_id
     * @return mixed
     */
    public function get(string $slug)
    {
        return $this->findSingle('slug', '=', $slug);
    }
}
