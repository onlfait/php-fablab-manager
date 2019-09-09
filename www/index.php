<?php
// Absolute path to root directory (www)
define('PFM_ROOT_PATH', dirname(__FILE__) . '/');

// Absolute path to PHP Fablab Manager directory
define('PFM_PATH', PFM_ROOT_PATH . 'pfm/');

// Require the global state
require_once PFM_PATH . 'state/init.php';

// Require commons functions
require_once PFM_PATH . 'functions/commons.php';

// DB connection
require_once PFM_PATH . 'functions/db.php';

// Layout helpers
require_once PFM_PATH . 'functions/layout.php';

// Start a session
session_start();

// Database connection
pfm_db_connect();

// Dispatch main request
pfm_dispatch_route($_GET);

// Database disconnect
pfm_db_disconnect();
