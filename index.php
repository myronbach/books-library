<?php

use core\Router;




define('ROOT', dirname(__FILE__));
define('APP', dirname(__FILE__).'/app');
define('VIEWS', APP.'/views');

// default layout
define('LAYOUT', 'layout/main');

// DB setup
define('DNS', 'sqlite:/ vendor/bin/heroku-php-apache2/base.sqlite');

// display items
define('SHOW_DEFAULT', 5);

require_once 'core/autoload.php';
require_once 'core/functions.php';

session_start();


$query = rtrim($_SERVER['QUERY_STRING'], '/');
/*
 * |------------------------------------------------------------------------
 * | Routes
 * |
 * */
//books/create  create()
Router::add('^books/create$', ['controller' => 'Books', 'action' => 'create']);

// books/store  store()
Router::add('^books/store$', ['controller' => 'Books', 'action' => 'store']);

// books/id         show()
Router::add('^books/(?P<alias>[a-z0-9-]+)$', ['controller' => 'Books', 'action' => 'show']);

// books/id/edit edit()
// books/id/update  update()
// books/id/delete  delete()
Router::add('^books/(?P<alias>[a-z0-9-]+)/(?P<action>[a-z-]+)$', ['controller' => 'Books']);




Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/(?P<alias>[a-z0-9-]+)?$');


// Default routes
//  '/' index
Router::add('^$', ['controller' => 'Books', 'action' => 'index']);

// books/create create() ;   books/store store()
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

/*
 * |----------------------------------------------------------------------------
 * */

Router::dispatch($query);




