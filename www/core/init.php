<?php
// require core functions
require_once(PFM_ROOT_PATH . 'core/functions/debug.php');
require_once(PFM_ROOT_PATH . 'core/functions/array.php');
require_once(PFM_ROOT_PATH . 'core/functions/state.php');
require_once(PFM_ROOT_PATH . 'core/functions/format.php');
require_once(PFM_ROOT_PATH . 'core/functions/url.php');
require_once(PFM_ROOT_PATH . 'core/functions/router.php');

// require main state file
require_once(PFM_ROOT_PATH . 'state.php');

// initialize router (modules)
routerInit();

// dispatch main request (GET)
routerDispatch($_GET);

// DEBUG state
debugVar($_PFM);