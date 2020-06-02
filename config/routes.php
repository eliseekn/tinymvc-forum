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
    'name' => 'home',
    'middlewares' => [
        'remember_me'
    ]
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
        'name' => 'auth_page',
        'middlewares' => [
            'remember_me'
        ]
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
    ],
    '/comment/delete/{commentId:int}' => [
        'controller' => 'CommentController@delete'
    ],
    '/category/delete/{categoryId:int}' => [
        'controller' => 'CategoryController@delete'
    ],
    '/topic/delete/{topicId:int}' => [
        'controller' => 'TopicController@delete'
    ],
    '/topic/open/{topicId:int}' => [
        'controller' => 'TopicController@open'
    ],
    '/topic/close/{topicId:int}' => [
        'controller' => 'TopicController@close'
    ],
    '/user/delete/{userId:int}' => [
        'controller' => 'UserController@delete'
    ],
    '/utilisateur/profil/{userId:int}' => [
        'controller' => 'UserController@profile'
    ]
])->by([
    'method' => 'GET'
]);

Route::add('/user/login', [
    'method' => 'POST',
    'controller' => 'UserController@login',
    'middlewares' => [
        'csrf', 
        'sanitize'
    ]
]);

Route::group([
    '/user/add' => [
        'controller' => 'UserController@add'
    ],
    '/category/add' => [
        'controller' => 'CategoryController@add'
    ],
    '/category/update/{categoryId:int}' => [
        'controller' => 'CategoryController@update'
    ],
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
    ],
    '/user/update/{userId:int}' => [
        'controller' => 'UserController@update'
    ]
])->by([
    'method' => 'POST',
    'middlewares' => [
        'sanitize'
    ]
]);

Route::group([
    '/admin/forums' => [
        'controller' => 'AdminController@categories',
        'name' => 'admin'
    ],
    '/admin/sujets' => [
        'controller' => 'AdminController@topics'
    ],
    '/admin/utilisateurs' => [
        'controller' => 'AdminController@users'
    ],
    '/admin/messages' => [
        'controller' => 'AdminController@comments'
    ],
    '/admin' => [
        'controller' => 'AdminController@categories',
        'name' => 'admin'
    ]
])->by([
    'method' => 'GET',
    'middlewares' => [
        'remember_me',
        'admin_session'
    ]
]);