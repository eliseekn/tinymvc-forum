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
		$this->users = new UsersModel();
        $this->request = new Request();
        $this->validator = new RegistrationValidator();
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
     * display profile page
     *
     * @return void
     */
    public function profile(int $id): void
    {
        $this->renderView('forum/profile', [
            'page_title' => 'Profil d\'utilisateur | eduForum',
            'page_description' => 'Page de modification du profil d\'tulisateur',
            'user' => $this->users->find($id)
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
		
        if ($this->users->isRegistered($email, $password)) {
            create_session('user', $this->users->findEmail($email));
            
            if (!empty($this->request->getInput('remember-me'))) {
                create_cookie('user', $email);
            }

			Redirect::toRoute('home')->only();
		}

		Redirect::toRoute('auth_page')->withMessage('errors', 'Votre adresse email ou/et mot de passe est incorrect.');
    }
    
    /**
     * add new user
     *
     * @return void
     */
    public function add(): void
    {
        $error_messages = $this->validator->validate();

        if ($error_messages !== '') {
            Redirect::toRoute('registration_page')->withMessage('errors', $error_messages);
        }

        $email = $this->request->getInput('email');

        if ($this->users->isAlreadyRegistered($email)) {
            Redirect::toRoute('registration_page')->withMessage('errors', 'L\'adresse email renseignée est déjà utilisée par un autre utilisateur.');
        }

        $this->users->setData([
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
     * update new user
     *
     * @return void
     */
    public function update(int $id): void
    {
        $error_messages = $this->validator->validate();

        if ($error_messages !== '') {
            Redirect::toUrl('/utilisateur/profil/' . $id)->withMessage('errors', $error_messages);
        }

        if (!empty($this->request->getInput('new-password'))) {
            $password = $this->request->getInput('new-password');
        } else {
            $password = $this->request->getInput('old-password');
        }

        $this->users->setData([
            'name' => $this->request->getInput('name'),
            'gender' => $this->request->getInput('gender'),
            'department' => $this->request->getInput('department'),
            'grade' => $this->request->getInput('grade'),
            'email' => $this->request->getInput('email'),
            'password' => hash_string($password),
            'updated_at' => date("Y-m-d H:i:s")
        ])->update($id);

		Redirect::toUrl('/utilisateur/profil/' . $id)->withMessage('success', 'Votre profil a bien été mis à jour avec succès.');
    }
	
	/**
	 * logout user
	 *
	 * @return void
	 */
	public function logout(): void
	{
        close_session('user');
        delete_cookie('user');
		Redirect::toRoute('home')->only();
	}
	
	/**
	 * delete user
	 *
	 * @param  int $id
	 * @return void
	 */
	public function delete(int $id): void
	{
		$this->users->delete($id);
		Redirect::back()->withMessage('success', 'L\'utilisateur a bien été supprimé avec succès.');
	}
}