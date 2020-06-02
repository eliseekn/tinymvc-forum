<?php

namespace App\Middlewares;

use App\Database\Models\UsersModel;

/**
 * CheckUserCookie
 * 
 * Check for user cookie
 */
class CheckUserCookie
{    
    /**
     * handle function
     *
     * @return void
     */
    public function handle()
    {
        $users = new UsersModel();
    
        if (cookie_has('user')) {
            $user_data = $users->get(get_cookie('user'));
        }

        if (!empty($user_data)) {
            create_session('user', $user_data);
        }
    }
}
