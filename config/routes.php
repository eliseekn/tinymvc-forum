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
    '/sujet/nouveau' => [
        'controller' => 'TopicController@new',
        'name' => 'add_topic'
    ],
    '/sujet/{slug:str}' => [
        'controller' => 'TopicController@index'
    ],
    '/sujet/modifier/{id:int}' => [
        'controller' => 'TopicController@edit',
        'name' => 'edit_topic'
    ],
    '/rechercher' => [
        'controller' => 'TopicController@search'
    ],
    '/connexion' => [
        'controller' => 'UserController@index',
        'name' => 'auth_page'
    ],
    '/inscription' => [
        'controller' => 'UserController@register',
        'name' => 'register_page'
    ],
    '/deconnexion' => [
        'controller' => 'UserController@logout'
    ]
])->by([
    'method' => 'GET'
]);

Route::group([
    '/user/login' => [
        'controller' => 'UserController@login',
        'middlewares' => [
            'csrf', 
            'sanitize'
        ]
    ], 
    '/user/add' => [
        'controller' => 'UserController@add',
        'middlewares' => [
            'sanitize'
        ]
    ]
])->by([
    'method' => 'POST',
]);
