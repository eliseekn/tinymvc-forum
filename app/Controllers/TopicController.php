<?php

namespace App\Controllers;

use Framework\Core\Controller;
use App\Database\Models\TopicsModel;
use App\Database\Models\CommentsModel;
use Framework\Http\Request;

/**
 * TopicController
 * 
 * Topic page controller
 */
class TopicController extends Controller
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
	 * display topic page
	 *
	 * @return void
	 */
	public function index(string $slug): void
	{
        $topic = $this->topics->get($slug);
        
		$this->renderView('topic', [
			'page_title' => $topic->title . ' | eduForum',
			'page_description' => 'Discussions sur le sujet ' . $topic->title,
			'topic' => $topic,
			'comments' => $this->comments->get($topic->id)
		]);
	}
	
	/**
	 * dispaly search results page
	 *
	 * @return void
	 */
	public function search(): void
	{
		$request = new Request();
		$search_query = $request->getQuery('q');

		$topics = $this->topics->paginateTopicsSearch(10);
		$highest_votes = [];

		foreach($topics as $topic) {
			$highest_votes[] = $this->comments->highestVote($topic->id);
		}

		$this->renderView('search', [
			'page_title' => 'Résultats de la recherche pour "' . $search_query . '" | eduForum',
			'page_description' => 'Rechercher des sujets de discussion',
			'topics' => $topics,
			'search_query' => $search_query,
			'highest_votes' => $highest_votes
		]);
	}
}
