<?php
/**
 * Single entry point of PHP Fablab Manager.
 *
 * This file is responsible for :
 * - Defines constants
 * - Autoload classes
 * - Map routes to controllers
 * - Dispatch the request
 */
namespace PFM;

/** Absolute path to root directory (www) */
define('PFM\ROOT_PATH', \dirname(__FILE__));

/** Absolute path to classes directory */
define('PFM\CLASSES_PATH', ROOT_PATH . '/classes');

/** Absolute path to views directory */
define('PFM\VIEWS_PATH', ROOT_PATH . '/views');

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
Router::notFound('\PFM\Controllers\Error404');

// Map routes to controllers
Router::addRoute('/', '\PFM\Controllers\Home');
Router::addRoute('/events', '\PFM\Controllers\Events');
Router::addRoute('/contact', '\PFM\Controllers\Contact');

// Dispatch the request
Router::dispatch(Router::uri());
