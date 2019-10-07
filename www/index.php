<?php namespace PFM;

// Absolute path to root directory (www)
define('PFM\ROOT_PATH', dirname(__FILE__));

// Absolute paths to commons directories
define('PFM\CLASSES_PATH', ROOT_PATH . '/classes');
define('PFM\VIEWS_PATH'  , ROOT_PATH . '/views');

// Import the classes autoloader
require_once CLASSES_PATH . '/PFM/Autoloader.php';

Autoloader::addPath(CLASSES_PATH);
Autoloader::register();

// Add views directory
View::addPath(VIEWS_PATH);

// Set some route tokens
// Router::setToken('id', '[0-9]+');
// Router::setToken('title', '[a-zA-Z0-9_\-\.]+');

// Add Error 404 controller
Router::notFound('\OLF\Controllers\Error404');

// Map routes and controllers
Router::addRoute('/'       , '\OLF\Controllers\Home');
Router::addRoute('/events' , '\OLF\Controllers\Events');
Router::addRoute('/contact', '\OLF\Controllers\Contact');

// Dispatch the request
Router::dispatch(Router::uri());
