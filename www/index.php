<?php
// Absolute path to root directory (www)
define('PFM_ROOT_PATH', dirname(__FILE__) . '/');

// Require the global state
require_once PFM_ROOT_PATH . 'state/init.php';

// Require commons functions
require_once PFM_ROOT_PATH . 'functions/commons.php';

// Dispatch main request
pfm_dispatch_route($_GET);
