<?php
namespace PFM;

// Absolute path to root directory (www)
define('PFM\ROOT_PATH', dirname(__FILE__));

// Absolute path to PFM directory
define('PFM\PFM_PATH', ROOT_PATH . '/PFM');

// Import and register the autoloader
require_once PFM_PATH . '/Autoloader.php';

Autoloader::addPath(PFM_PATH . '/classes');
Autoloader::register();

// Add some routes
Router::addRoute('/');

// Dispatch the request
$request = '/';

Router::dispatch($request, function (...$args) {
  var_dump(['routeHandler', $args]);
});

// DEBUG
var_dump(Router::$_routes);
