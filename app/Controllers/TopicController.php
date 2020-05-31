<?php

namespace App\Controllers;

use Framework\Http\Request;
use Framework\Http\Redirect;
use Framework\Core\Controller;
use Framework\Support\Storage;
use App\Validators\TopicValidator;
use App\Database\Models\VotesModel;
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
		$this->request = new Request();
		$this->validator = new TopicValidator();
        $this->votes = new VotesModel();
	}

	/**
	 * display topic page
	 *
	 * @return void
	 */
	public function index(string $slug): void
	{
		$topic = $this->topics->get($slug);
		$comments = $this->comments->paginateComments($topic->id, 10);
		$voters = [];

		if (session_has('user')) {
			foreach($comments as $comment) {
				$voters[] = $this->votes->get(get_session('user')->id, $comment->id);
			}
		}

		$this->renderView('forum/topic', [
			'page_title' => $topic->title . ' | eduForum',
			'page_description' => 'Discussions sur le sujet ' . $topic->title,
			'topic' => $topic,
			'comments' => $comments,
			'voters' => $voters
		]);
	}
	
	/**
	 * dispaly search results page
	 *
	 * @return void
	 */
	public function search(): void
	{
		$search_query = $this->request->getQuery('q');

		$topics = $this->topics->paginateTopicsSearch(10);
		$highest_votes = [];

		foreach($topics as $topic) {
			$highest_votes[] = $this->comments->highestVote($topic->id);
		}

		$this->renderView('forum/search', [
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
		$this->renderView('forum/add_topic', [
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
		$this->renderView('forum/edit_topic', [
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
        $error_messages = $this->validator->validate();

        if ($error_messages !== '') {
            Redirect::toRoute('topic_add')->withMessage('validator_errors', $error_messages);
		}

		$slug = slugify($this->request->getInput('title'));
		$attachments = $this->request->getFile('attachments');

		if (!empty($attachments)) {
			if (!Storage::createDir('uploads/' . $slug, true)) {
				create_flash_message('upload_error', 'Une erreur est survenue lors du chargement des fichiers joints.');
			}

			foreach ($attachments as $attachment) {
				if ($attachment->moveTo('uploads/' . $slug)) {
					$_attachments[] = $attachment->filepath;
				}
			}
		}

		$attachments = empty($_attachments) ? '' : implode(',', $_attachments);
		
		$this->topics->setData([
			'title' => $this->request->getInput('title'),
			'slug' => $slug,
			'content' => $this->request->getInput('content'),
			'user_id' => get_session('user')->id,
			'cat_id' => random_int(1, 4),
			'attachments' => $attachments,
		])->save();

		Redirect::toRoute('topic_add')->withMessage('add_success', 'Votre sujet a bien été ajouté avec succès.');
	}
	
	/**
	 * edit topic
	 *
	 * @param  int $id topic id
	 * @return void
	 */
	public function update(int $id): void
	{
        $error_messages = $this->validator->validate();

        if ($error_messages !== '') {
            Redirect::back()->withMessage('validator_errors', $error_messages);
		}
		
		$this->topics->setData([
			'title' => $this->request->getInput('title'),
			'slug' => slugify($this->request->getInput('title')),
			'content' => $this->request->getInput('content'),
			'cat_id' => random_int(1, 4)
		])->update($id);

		Redirect::back()->withMessage('edit_success', 'Votre sujet a bien été modifié avec succès.');
	}
	
	/**
	 * delete topic and attachments
	 *
	 * @param  mixed $id
	 * @return void
	 */
	public function delete(int $id): void
	{
		$topic = $this->topics->find($id);

		if (empty($topic->attachments)) {
			$this->topics->delete($id);
			Redirect::back()->withMessage('delete_success', 'Le sujet a bien été supprimé avec succès.');
		}

		Storage::deleteDir('uploads/' . $topic->slug);

		if (!Storage::isDir('uploads/' . $topic->slug)) {
			$this->topics->delete($id);
			Redirect::back()->withMessage('delete_success', 'Le sujet a bien été supprimé avec succès.');
		}

		Redirect::back()->withMessage('delete_failed', 'Une erreur est survenue lors de la suppression du sujet.');
	}
}
