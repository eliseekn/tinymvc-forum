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

/**
 * Application main configuration
 */

//define application root folder. Leave empty for server root
define('ROOT_FOLDER', '/tinymvc-forum');

//domain url
define('WEB_DOMAIN', 'http://localhost' . ROOT_FOLDER);

//absolute application path
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR);

//public folder path
define('PUBLIC_STORAGE', DOCUMENT_ROOT . trim(ROOT_FOLDER, '/') . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);

//errors display configuration
define('DISPLAY_ERRORS', true);

//session lifetime
define('SESSION_LIFETIME', 3600);

//custom errors page
define('ERRORS_PAGE', [
    '404' => '404',
    '403' => '403'
]);