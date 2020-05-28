<?php

namespace App\Controllers;

use Framework\Core\Controller;
use App\Database\Models\TopicsModel;
use App\Database\Models\CommentsModel;

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
}
