<?php
require '../../www/classes/PFM/Router.php';

use \PFM\Router;

// Home controller
function home(array $args = null)
{
    echo 'Home controller';
}

// Contact controller
function contact(array $args = null)
{
    echo 'Home controller';
}

// User controller
function user(array $args = null)
{
    echo 'Hello ' . $args['name'];
}

// Error 404
function error404(array $args = null)
{
    echo 'Error 404 - Page Not Found';
}

// Map routes to controllers
Router::addRoute('/home', 'home');
Router::addRoute('/contact', 'contact');
Router::addRoute('/user/<name>', 'user');

// Add Error 404 controller
Router::notFound('error404');

// Dispatch the request
Router::dispatch(Router::uri());
