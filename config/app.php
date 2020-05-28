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
define('ROOT_FOLDER', '/tinymvc');

//domain url
define('WEB_DOMAIN', 'http://localhost' . ROOT_FOLDER);

//absolute application path
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR);

//public folder path
define('PUBLIC_STORAGE', DOCUMENT_ROOT . 'tinymvc' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);

//errors display configuration
define('DISPLAY_ERRORS', true);

//custom errors page
define('ERRORS_PAGE', [
    '404' => ''
]);