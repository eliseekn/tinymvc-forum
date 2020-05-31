<?php

namespace App\Controllers;

use Framework\Core\Controller;
use App\Database\Models\TopicsModel;
use App\Database\Models\CommentsModel;

/**
 * HomeController
 * 
 * Home page controller
 */
class HomeController extends Controller
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
	}

	/**
	 * display home page
	 *
	 * @return void
	 */
	public function index(): void
	{
		$topics = $this->topics->paginateTopics(10);
		$highest_votes = [];

		foreach($topics as $topic) {
			$highest_votes[] = $this->comments->highestVote($topic->id);
		}

		$this->renderView('forum/home', [
			'page_title' => "eduForum - Forum d'échanges des étudiants de Côte d'Ivoire",
			'page_description' => "eduForum est un forum d'échanges des étudiants de Côte d'Ivoire",
			'topics' => $topics,
			'highest_votes' => $highest_votes
		]);
	}
}
