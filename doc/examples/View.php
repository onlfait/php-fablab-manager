<?php
require '../../www/classes/PFM/View.php';

use \PFM\View;

// Add views directory
View::addPath('./views');

// Create a view object from file (./views/helloworld.php)
$view = new View('helloworld.php');

// Set some data
$view->set('title', 'Hello World');
$view->set('message', 'My name is ...');

// display the view
$view->display();

// ---

// Create the layout view
$layout = new View('layout.php');

// Set layout title
$layout->set('title', 'Hello World');

// Create the contents view
$contents = new View('helloworld.php');

// Set contents data
$contents->set('message', 'My name is ...');

// Set the contents view as layout data
$layout->set('contents', $contents);

// Render the layout
$layout->display();
