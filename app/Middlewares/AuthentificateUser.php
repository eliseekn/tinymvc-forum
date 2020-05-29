<?php

namespace App\Middlewares;

use App\Validators\LoginValidator;
use Framework\Http\Redirect;

/**
 * AuthentificateUser
 * 
 * Validate user authentification
 */
class AuthentificateUser
{    
    /**
     * handle function
     *
     * @return void
     */
    public function handle()
    {
        $validator = new LoginValidator();
        $error_messages = $validator->validate();

        if (!empty($error_messages)) {
            Redirect::back()->withMessage('validator_errors', $error_messages);
        }
    }
}