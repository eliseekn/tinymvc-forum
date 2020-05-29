<?php

namespace App\Controllers;

use Framework\Http\Request;
use Framework\Http\Redirect;
use Framework\Core\Controller;
use App\Validators\TopicValidator;
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
	
	/**
	 * display add topic page
	 *
	 * @return void
	 */
	public function new(): void
	{
		$this->renderView('add_topic', [
			'page_title' => 'Nouveau sujet de discussion | eduForum',
			'page_description' => 'Ajouter un nouveau sujet de discussion'
		]);
	}

	/**
	 * display edit topic page
	 *
	 * @param  int $id topic id
	 * @return void
	 */
	public function edit(int $id): void
	{
		$this->renderView('edit_topic', [
			'page_title' => 'Modifier un sujet de discussion | eduForum',
			'page_description' => 'Modifier un sujet de discussion',
			'topic' => $this->topics->find($id)
		]);
	}
	
	/**
	 * add new topic
	 *
	 * @return void
	 */
	public function add(): void
	{
		$validator = new TopicValidator();
        $error_messages = $validator->validate();

        if ($error_messages !== '') {
            Redirect::toRoute('register_page')->withMessage('validator_errors', $error_messages);
		}
		
		$this->topics->setData([
			'title' => $this->request->getInput('title'),
			'slug' => slugify($this->request->getInput('title')),
			'content' => $this->request->getInput('content'),
			'user_id' => get_session('user')->id,
			'cat_id' => get_session('user')->id,
			'attachments' => '',
		])->save();

		Redirect::toRoute('add_topic')->withMessage('add_success', 'Votre sujet a bien été ajouté avec succès.');
	}
	
	/**
	 * edit topic
	 *
	 * @param  int $id topic id
	 * @return void
	 */
	public function update(int $id): void
	{
		$validator = new TopicValidator();
        $error_messages = $validator->validate();

        if ($error_messages !== '') {
            Redirect::toRoute('register_page')->withMessage('validator_errors', $error_messages);
		}
		
		$this->topics->setData([
			'title' => $this->request->getInput('title'),
			'slug' => slugify($this->request->getInput('title')),
			'content' => $this->request->getInput('content'),
			'user_id' => get_session('user')->id,
			'cat_id' => get_session('user')->id,
			'attachments' => '',
		])->update($id);

		Redirect::back()->withMessage('edit_success', 'Votre sujet a bien été modifié avec succès.');
	}
}
