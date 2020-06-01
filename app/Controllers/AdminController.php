<?php

namespace App\Controllers;

use App\Database\Models\CategoriesModel;
use Framework\Core\Controller;

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
        //
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