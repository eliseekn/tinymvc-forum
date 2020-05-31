<?php

namespace App\Controllers;

use Framework\Http\Request;
use Framework\Http\Redirect;
use Framework\Core\Controller;
use Framework\Support\Storage;
use App\Database\Models\VotesModel;
use App\Database\Models\TopicsModel;
use App\Validators\CommentValidator;
use App\Database\Models\CommentsModel;

/**
 * CommentController
 * 
 * Manage users comments
 */
class CommentController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->comments = new CommentsModel();
        $this->topics = new TopicsModel();
        $this->request = new Request();
        $this->validator = new CommentValidator();
        $this->votes = new VotesModel();
    }
    
    /**
     * add new comment
     *
     * @param  int $id
     * @return void
     */
    public function add(int $post_id): void
    {
        $topic = $this->topics->find($post_id);
        $error_messages = $this->validator->validate();

        if ($error_messages !== '') {
            Redirect::toUrl('/sujet/' . $topic->slug)->withMessage('validator_errors', $error_messages);
		}

		$attachments = $this->request->getFile('attachments');

		if (!empty($attachments)) {
			if (!Storage::createDir('uploads/' . $topic->slug . '/' . get_session('user')->id, true)) {
				create_flash_message('upload_error', 'Une erreur est survenue lors du chargement des fichiers joints.');
			}

			foreach ($attachments as $attachment) {
				if ($attachment->moveTo('uploads/' . $topic->slug . '/' . get_session('user')->id)) {
					$_attachments[] = $attachment->filepath;
				}
			}
		}

		$attachments = empty($_attachments) ? '' : implode(',', $_attachments);
		
		$this->comments->setData([
			'content' => $this->request->getInput('content'),
			'user_id' => get_session('user')->id,
			'topic_id' => $topic->id,
			'attachments' => $attachments,
        ])->save();
        
        $this->topics->incCommentsCount($topic->id);

		Redirect::toUrl('/sujet/' . $topic->slug)->withMessage('add_success', 'Votre message de réponse a bien été ajoutée avec succès.');
    }
    
    /**
     * update comment
     *
     * @param  int $id comment id
     * @return void
     */
    public function update(int $id): void
    {
        $error_messages = $this->validator->validate();

        if ($error_messages !== '') {
            create_flash_message('validator_errors', $error_messages);
        }
        
        $this->comments->setData([
            'content' => $this->request->getInput('content')
        ])->update($id);

        create_flash_message('edit_success', 'Votre message de réponse a bien été modifiée avec succès.');
    }
    
    /**
     * vote a comment
     *
     * @param  int $comment_id comment id
     * @return void
     */
    public function vote(int $comment_id): void
    {
        $this->comments->incVotes($comment_id);
        
        $this->votes->setData([
            'user_id' => get_session('user')->id,
            'comment_id' => $comment_id
        ])->save();

        Redirect::back()->withMessage('vote_success', 'Votre vote a bien été pris en compte, vous pouvez l\'annuler à tout moment.');
    }
    
    /**
     * dismiss vote
     *
     * @param  int $comment_id comment id
     * @return void
     */
    public function dismissVote(int $comment_id): void
    {
        $this->comments->decVotes($comment_id);
        $this->votes->dismissVote(get_session('user')->id, $comment_id);
        Redirect::back()->withMessage('vote_success', 'Votre vote a bien été annulé.');
    }
}