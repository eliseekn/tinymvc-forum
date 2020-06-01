<?php

namespace App\Controllers;

use Framework\Core\Controller;
use App\Database\Models\TopicsModel;
use App\Database\Models\CommentsModel;
use App\Database\Models\CategoriesModel;

/**
 * CategoryController
 * 
 * Categories page controller
 */
class CategoryController extends Controller
{	
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->topics = new TopicsModel();
		$this->comments = new CommentsModel();
		$this->categories = new CategoriesModel();
	}

	/**
	 * display category page
	 *
	 * @return void
	 */
	public function index(string $slug): void
	{
		$category = $this->categories->get($slug);
		$topics = $this->topics->paginateTopics($category->id, 10);
		$highest_votes = [];

		foreach($topics as $topic) {
			$highest_votes[] = $this->comments->highestVote($topic->id);
		}

		$this->renderView('forum/category', [
			'page_title' => "eduForum - Forum d'échanges des étudiants de Côte d'Ivoire",
			'page_description' => "eduForum est un forum d'échanges des étudiants de Côte d'Ivoire",
			'topics' => $topics,
			'highest_votes' => $highest_votes,
			'category_name' => $category->name
		]);
	}
}
