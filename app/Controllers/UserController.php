<?php

namespace App\Controllers;

use Framework\Http\Request;
use Framework\Http\Redirect;
use Framework\Core\Controller;
use App\Validators\LoginValidator;
use App\Database\Models\UsersModel;
use App\Validators\RegistrationValidator;

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
		$this->user = new UsersModel();
        $this->request = new Request();
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
    public function register(): void
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
        $validator = new LoginValidator();
        $error_messages = $validator->validate();

        if ($error_messages !== '') {
            Redirect::toRoute('auth_page')->withMessage('errors', $error_messages);
        }
        
        $email = $this->request->getInput('email');
		$password = $this->request->getInput('password');
		
        if ($this->user->isRegistered($email, $password)) {
			create_session('user', $this->user->get($email));
			Redirect::toRoute('home')->only();
		}

		Redirect::toRoute('auth_page')->withMessage('failed', 'Votre adresse email ou/et mot de passe est incorrect.');
    }
    
    /**
     * add new user
     *
     * @return void
     */
    public function add(): void
    {
        $validator = new RegistrationValidator();
        $error_messages = $validator->validate();

        if ($error_messages !== '') {
            Redirect::toRoute('registration_page')->withMessage('errors', $error_messages);
        }

        $email = $this->request->getInput('email');

        if ($this->user->isAlreadyRegistered($email)) {
            Redirect::toRoute('registration_page')->withMessage('failed', 'L\'adresse email renseignée est déjà utilisée par un autre utilisateur.');
        }

        $this->user->setData([
            'name' => $this->request->getInput('name'),
            'gender' => $this->request->getInput('gender'),
            'department' => $this->request->getInput('department'),
            'grade' => $this->request->getInput('grade'),
            'email' => $this->request->getInput('email'),
            'password' => hash_string($this->request->getInput('password'))
        ])->save();

		Redirect::toRoute('auth_page')->withMessage('success', 'Votre inscription au forum a été validée. Vous pouvez maintenant vous connecter.');
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