<?php

namespace App\Middlewares;

use Framework\Http\Redirect;

/**
 * CheckUserSession
 * 
 * Check for user logged session
 */
class CheckUserSession
{    
    /**
     * handle function
     *
     * @return void
     */
    public function handle()
    {
        if (empty(get_session('user'))) {
            Redirect::toRoute('auth_page')->withMessage('session_error', 'Vous n\'êtes pas encore connecté à votre compte.');
        }
    }
}
