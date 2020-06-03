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
    'handler' => 'HomeController@index',
    'name' => 'home',
    'middlewares' => [
        'remember_me'
    ]
]);

Route::group([
    '/sujet/nouveau' => [
        'handler' => 'TopicController@new',
        'name' => 'topic_add'
    ],
    '/sujet/modifier/{id:int}' => [
        'handler' => 'TopicController@edit',
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
        'handler' => 'TopicController@index'
    ],
    '/forum/{slug:str}' => [
        'handler' => 'CategoryController@index'
    ],
    '/rechercher' => [
        'handler' => 'TopicController@search'
    ],
    '/connexion' => [
        'handler' => 'UserController@index',
        'name' => 'auth_page',
        'middlewares' => [
            'remember_me'
        ]
    ],
    '/inscription' => [
        'handler' => 'UserController@register',
        'name' => 'registration_page'
    ],
    '/deconnexion' => [
        'handler' => 'UserController@logout'
    ],
    '/comment/vote/{commentId:int}' => [
        'handler' => 'CommentController@vote'
    ],
    '/comment/dismiss_vote/{commentId:int}' => [
        'handler' => 'CommentController@dismissVote'
    ],
    '/comment/delete/{commentId:int}' => [
        'handler' => 'CommentController@delete'
    ],
    '/category/delete/{categoryId:int}' => [
        'handler' => 'CategoryController@delete'
    ],
    '/topic/delete/{topicId:int}' => [
        'handler' => 'TopicController@delete'
    ],
    '/topic/open/{topicId:int}' => [
        'handler' => 'TopicController@open'
    ],
    '/topic/close/{topicId:int}' => [
        'handler' => 'TopicController@close'
    ],
    '/user/delete/{userId:int}' => [
        'handler' => 'UserController@delete'
    ],
    '/utilisateur/profil/{userId:int}' => [
        'handler' => 'UserController@profile'
    ]
])->by([
    'method' => 'GET'
]);

Route::add('/user/login', [
    'method' => 'POST',
    'handler' => 'UserController@login',
    'middlewares' => [
        'csrf', 
        'sanitize'
    ]
]);

Route::group([
    '/user/add' => [
        'handler' => 'UserController@add'
    ],
    '/category/add' => [
        'handler' => 'CategoryController@add'
    ],
    '/category/update/{categoryId:int}' => [
        'handler' => 'CategoryController@update'
    ],
    '/topic/add' => [
        'handler' => 'TopicController@add'
    ],
    '/topic/update/{id:int}' => [
        'handler' => 'TopicController@update'
    ],
    '/comment/update/{commentId:int}' => [
        'handler' => 'CommentController@update'
    ],
    '/comment/add/{postId:int}' => [
        'handler' => 'CommentController@add'
    ],
    '/user/update/{userId:int}' => [
        'handler' => 'UserController@update'
    ]
])->by([
    'method' => 'POST',
    'middlewares' => [
        'sanitize'
    ]
]);

Route::group([
    '/admin/forums' => [
        'handler' => 'AdminController@categories',
        'name' => 'admin'
    ],
    '/admin/sujets' => [
        'handler' => 'AdminController@topics'
    ],
    '/admin/utilisateurs' => [
        'handler' => 'AdminController@users'
    ],
    '/admin/messages' => [
        'handler' => 'AdminController@comments'
    ],
    '/admin' => [
        'handler' => 'AdminController@categories',
        'name' => 'admin'
    ]
])->by([
    'method' => 'GET',
    'middlewares' => [
        'remember_me',
        'admin_session'
    ]
]);
