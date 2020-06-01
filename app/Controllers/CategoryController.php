<?php

namespace App\Controllers;

use Framework\Http\Redirect;
use Framework\Core\Controller;
use App\Database\Models\TopicsModel;
use App\Validators\CategoryValidator;
use App\Database\Models\CommentsModel;
use App\Database\Models\CategoriesModel;
use Framework\Http\Request;

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
		$this->validator = new CategoryValidator();
		$this->request = new Request();
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
	
	/**
	 * add new category
	 *
	 * @return void
	 */
	public function add(): void
	{
        $error_messages = $this->validator->validate();

        if ($error_messages !== '') {
            Redirect::toRoute('admin')->withMessage('errors', $error_messages);
		}

		$this->categories->setData([
			'name' => $this->request->getInput('name'),
			'slug' => slugify($this->request->getInput('name')),
			'description' => $this->request->getInput('description')
		])->save();

		Redirect::toRoute('admin')->withMessage('success', 'Le forum a bien été créé avec succès.');
	}
	
	/**
	 * update new category
	 *
	 * @param  int $id
	 * @return void
	 */
	public function update(int $id): void
	{
        $error_messages = $this->validator->validate();

        if ($error_messages !== '') {
            create_flash_message('errors', $error_messages);
		}

		$this->categories->setData([
			'name' => $this->request->getInput('name'),
			'slug' => slugify($this->request->getInput('name')),
			'description' => $this->request->getInput('description')
		])->update($id);

		create_flash_message('success', 'Le forum a bien été modifié avec succès.');
	}
	
	/**
	 * delete category
	 *
	 * @param  int $id
	 * @return void
	 */
	public function delete(int $id): void
	{
		$this->categories->delete($id);
		Redirect::back()->withMessage('success', 'Le forum a bien été supprimé avec succès.');
	}
}
