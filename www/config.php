<?php
// Site settings
define('SITE_NAME', 'PHP Fablab Manager');
define('SITE_URL', 'http://localhost/');

// MySQL settings
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'php-fablab-manager');
define('DB_CHARSET' , 'utf8');
define('DB_PREFIX' , 'pfm_');

// Router settings
define('ROUTER_404', '404');
define('ROUTER_PAGES', 'pages/');
define('ROUTER_DEFAULT_PAGE', 'home');
define('ROUTER_DEFAULT_ACTION', '');

// DO NOT EDIT BELOW IF YOU DO NOT KNOW WHAT YOU ARE DOING

// define absolute path to pages directory
define('PAGES_PATH', ROOT_PATH . 'pages/');

// define absolute path to layout directory
define('LAYOUT_PATH', ROOT_PATH . 'layout/');

// define absolute path to errors directory
define('ERRORS_PATH', LAYOUT_PATH . 'errors/');
