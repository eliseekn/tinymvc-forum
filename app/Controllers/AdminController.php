<?php

namespace App\Controllers;

use Framework\Core\Controller;
use App\Database\Models\UsersModel;
use App\Database\Models\TopicsModel;
use App\Database\Models\CommentsModel;
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
            'topics' => $topics->paginateAllTopics(10)
        ]);
    }

    /**
     * display comments page
     *
     * @return void
     */
    public function comments(): void
    {
        $comments = new CommentsModel();

        $this->renderView('admin/comments', [
            'page_title' => 'Administration - Messages | eduForum',
            'page_description' => 'Gestion des messages de réponses',
            'comments' => $comments->paginateAllComments(10)
        ]);
    }

    /**
     * display users page
     *
     * @return void
     */
    public function users(): void
    {
        $users = new UsersModel();

        $total_topics = [];
        $total_comments = [];
        $total_votes = [];

        foreach($users->findAll() as $user) {
			$total_topics[] = $users->totalTopics($user->id);
			$total_comments[] = $users->totalComments($user->id);
			$total_votes[] = $users->totalVotes($user->id);
        }
        
        $this->renderView('admin/users', [
            'page_title' => 'Administration - Utilisateurs | eduForum',
            'page_description' => 'Gestion des utilisateurs',
            'users' => $users->paginate(10),
            'total_topics' => $total_topics, 
            'total_comments' => $total_comments, 
            'total_votes' => $total_votes 
        ]);
    }
}