<?php

namespace App\Middlewares;

use Framework\Core\View;
use Framework\Http\Redirect;

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
            Redirect::toRoute('auth_page')->withMessage('error', 'Vous n\'êtes pas encore connecté à votre compte.');
        }

        if ($user->role !== 'Administrateur') {
            View::error('403');
        }
    }
}
