<?php

/**
 * TinyMVC
 * 
 * PHP framework based on MVC architecture
 * 
 * @copyright 2019-2020 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/TinyMVC
 */

use Framework\Core\Route;

/**
 * Set routes paths
 */

Route::group([
    '/' => [],
    '/accueil' => []
])->by([
    'method' => 'GET',
    'controller' => 'HomeController@index',
    'name' => 'home'
]);

Route::group([
    '/sujet/{slug:str}' => [
        'controller' => 'TopicController@index'
    ],
    '/rechercher' => [
        'controller' => 'TopicController@search'
    ],
    '/connexion' => [
        'controller' => 'UserController@index',
        'name' => 'auth_page'
    ],
    '/inscription' => [
        'controller' => 'UserController@new'
    ],
    '/deconnexion' => [
        'controller' => 'UserController@logout'
    ]
])->by([
    'method' => 'GET'
]);

Route::group([
    '/login' => [
        'controller' => 'UserController@login',
        'middlewares' => [
            'csrf', 
            'sanitize', 
            'auth'
        ]
    ], 
    '/register' => [
        'controller' => 'UserController@register',
        'middlewares' => [
            'sanitize', 
            'auth'
        ]
    ]
])->by([
    'method' => 'POST',
]);