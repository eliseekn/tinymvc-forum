<?php

namespace App\Controllers;

use Framework\Http\Request;
use Framework\Http\Redirect;
use Framework\Core\Controller;
use App\Database\Models\UsersModel;

/**
 * UserController
 * 
 * User page controller
 */
class UserController extends Controller
{    
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->users = '';
    }
    
    /**
     * display login page
     *
     * @return void
     */
    public function index(): void
    {
        $this->renderView('login', [
            'page_title' => 'Connexion au forum | eduForum',
			'page_description' => 'Page de connexion au forum'
        ]);
    }
    
    /**
     * display register page
     *
     * @return void
     */
    public function new(): void
    {
        $this->renderView('register', [
            'page_title' => 'Inscription au forum | eduForum',
			'page_description' => 'Page d\'inscription au forum'
        ]);
    }
    
    /**
     * authentificate user
     *
     * @return void
     */
    public function login(): void
    {
        $request = new Request();
        $email = $request->getInput('email');
		$password = $request->getInput('password');
		
		$user = new UsersModel();

        if ($user->isRegistered($email, $password)) {
			create_session('user', $user->get($email));
			Redirect::toRoute('home')->only();
		}

		Redirect::toRoute('auth_page')->withMessage('login_failed', 'Votre adresse email et/ou mot de passe est incorrect.');
    }
    
    /**
     * register user
     *
     * @return void
     */
    public function register(): void
    {
        $request = new Request();
        $email = $request->getInput('email');
		$password = $request->getInput('password');
		
		$user = new UsersModel();

        if ($user->isRegistered($email, $password)) {
			create_session('user', $user->get($email));
			Redirect::toRoute('home')->only();
		}

		Redirect::toRoute('auth_page')->withMessage('login_failed', 'Votre adresse email et/ou mot de passe est incorrect.');
    }
	
	/**
	 * logout user
	 *
	 * @return void
	 */
	public function logout(): void
	{
		close_session('user');
		Redirect::toRoute('home')->only();
	}
}