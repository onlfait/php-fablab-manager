<?php
// define absolute root path (where this file is located)
define('ROOT_PATH', dirname(__FILE__) . '/');

// require global configuration
require(ROOT_PATH . 'config.php');

// require global helper functions
require(ROOT_PATH . 'helpers.php');

// require layout helpers
require(ROOT_PATH . 'layout.php');

// require database helpers
require(ROOT_PATH . 'db.php');

// require the URL router
require(ROOT_PATH . 'router.php');
