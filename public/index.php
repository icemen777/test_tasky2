<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
$rootpath =  dirname(__DIR__);

require $rootpath. '/vendor/autoload.php';



/**
 * Error and Exception handling
 */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


    define('PROJECT_BASE_PATH', $rootpath . '/');
	define('PROJECT_CORE_PATH', PROJECT_BASE_PATH . '/');
	define('PROJECT_TEMPLATES_PATH', PROJECT_CORE_PATH . 'Templates/');
	define('PROJECT_CACHE_PATH', PROJECT_CORE_PATH . 'Cache/');


	define('PROJECT_FENOM_OPTIONS', \Fenom::AUTO_RELOAD | \Fenom::FORCE_VERIFY);


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', array('controller' => 'tasks', 'action' => 'index'));
$router->add('tasks/index', array('controller' => 'Home', 'action' => 'index'));
$router->add('test/index', array('controller' => 'test', 'action' => 'index'));
$router->add('task/{id:\d+}', array('controller' => 'Tasks', 'action' => 'show'));

$router->add('tasks', array('controller' => 'Tasks', 'action' => 'index'));

$router->add('task/edit/{id:\d+}', array('controller' => 'Tasks', 'action' => 'edittask'));
$router->add('task/update', array('controller' => 'Tasks', 'action' => 'updateform'));

$router->add('loginform/', array('controller' => 'Auth', 'action' => 'loginform'));
$router->add('login/', array('controller' => 'Auth', 'action' => 'login'));
$router->add('logout/', array('controller' => 'Auth', 'action' => 'logout'));

$router->add('{controller}/{action}');




//var_dump($router->routes); die();
    
$router->dispatch($_SERVER['QUERY_STRING'], $_GET);
