<?php
// define absolute root path (where this file is located)
define('ROOT_PATH', dirname(__FILE__) . '/');

// require the global configuration
require(ROOT_PATH . 'config.php');

// require global helper functions
require(ROOT_PATH . 'helpers.php');

// require the layout helpers
require(ROOT_PATH . 'layout.php');

// require the URL router
require(ROOT_PATH . 'router.php');
