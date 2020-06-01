<?php

namespace App\Middlewares;

use Framework\Http\Redirect;
use Framework\Http\Response;

/**
 * CheckAdminSession
 * 
 * Check for user with administrator role session
 */
class CheckAdminSession
{    
    /**
     * handle function
     *
     * @return void
     */
    public function handle()
    {
        $user = get_session('user');

        if (empty($user)) {
            Redirect::toRoute('auth_page')->withMessage('session_error', 'Vous n\'êtes pas encore connecté à votre compte.');
        }

        if ($user->role !== 'Administrateur') {
            Response::send([], 'Vous n\'êtes pas autorisé à accéder à cette page.', 403);
        }
    }
}
