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
        'name' => 'topic_add'
    ],
    '/sujet/modifier/{id:int}' => [
        'controller' => 'TopicController@edit',
        'name' => 'topic_edit'
    ]
])->by([
    'method' => 'GET',
    'middlewares' => [
        'user_session'
    ]
]);

Route::group([
    '/sujet/{slug:str}' => [
        'controller' => 'TopicController@index'
    ],
    '/forum/{slug:str}' => [
        'controller' => 'CategoryController@index'
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
        'name' => 'registration_page'
    ],
    '/deconnexion' => [
        'controller' => 'UserController@logout'
    ],
    '/comment/vote/{commentId:int}' => [
        'controller' => 'CommentController@vote'
    ],
    '/comment/dismiss_vote/{commentId:int}' => [
        'controller' => 'CommentController@dismissVote'
    ]
])->by([
    'method' => 'GET'
]);

Route::group([
    '/topic/add' => [
        'controller' => 'TopicController@add'
    ],
    '/topic/update/{id:int}' => [
        'controller' => 'TopicController@update'
    ],
    '/comment/update/{commentId:int}' => [
        'controller' => 'CommentController@update'
    ],
    '/comment/add/{postId:int}' => [
        'controller' => 'CommentController@add'
    ]
])->by([
    'method' => 'POST'
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
    'method' => 'POST'
]);

Route::group([
    '/admin' => [
        'controller' => 'AdminController@categories',
        'name' => 'admin'
    ],
    '/admin/categories' => [
        'controller' => 'AdminController@categories',
        'name' => 'admin'
    ],
    '/admin/sujets-de-discussion' => [
        'controller' => 'AdminController@topics'
    ],
    '/admin/utilisateurs' => [
        'controller' => 'AdminController@users'
    ],
    '/admin/messages' => [
        'controller' => 'AdminController@comments'
    ]
])->by([
    'method' => 'GET',
    'middlewares' => [
        'admin_session'
    ]
]);