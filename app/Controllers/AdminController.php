<?php

namespace App\Controllers;

use Framework\Core\Controller;
use App\Database\Models\TopicsModel;
use App\Database\Models\CategoriesModel;

/**
 * AdminController
 * 
 * Manage administration pages
 */
class AdminController extends Controller
{    
    /**
     * display categories page
     *
     * @return void
     */
    public function categories(): void
    {
        $categories = new CategoriesModel();

        $this->renderView('admin/categories', [
            'page_title' => 'Administration - Forums | eduForum',
            'page_description' => 'Gestion des forums',
            'categories' => $categories->paginate(10)
        ]);
    }

    /**
     * display topics page
     *
     * @return void
     */
    public function topics(): void
    {
        $topics = new TopicsModel();

        $this->renderView('admin/topics', [
            'page_title' => 'Administration - Sujets de discussion | eduForum',
            'page_description' => 'Gestion des sujets de discussion',
            'topics' => $topics->paginateTopicsAll(10)
        ]);
    }

    /**
     * display comments page
     *
     * @return void
     */
    public function comments(): void
    {

    }

    /**
     * display users page
     *
     * @return void
     */
    public function users(): void
    {

    }
}