<?php

namespace App\Middlewares;

use Framework\Core\View;
use Framework\Http\Request;

/**
 * CsrfTokenValidator
 * 
 * CSRF token validator
 */
class CsrfTokenValidator
{    
    /**
     * handle function
     *
     * @return void
     */
    public function handle()
    {
        $request = new Request();
        $csrf_token = $request->getInput('csrf_token');

        if (!is_valid_csrf_token($csrf_token)) {
            View::error('403', 403);
        }
    }
}