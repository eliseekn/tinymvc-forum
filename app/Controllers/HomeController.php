<?php

namespace App\Controllers;

use Framework\Core\Controller;
use App\Database\Models\CategoriesModel;

/**
 * HomeController
 * 
 * Home page controller
 */
class HomeController extends Controller
{
	/**
	 * display home page
	 *
	 * @return void
	 */
	public function index(): void
	{
		$categories = new CategoriesModel();

		$this->renderView('forum/home', [
			'page_title' => "eduForum - Forum d'échanges des étudiants de Côte d'Ivoire",
			'page_description' => "eduForum est un forum d'échanges des étudiants de Côte d'Ivoire",
			'categories' => $categories->paginate(10)
		]);
	}
}
