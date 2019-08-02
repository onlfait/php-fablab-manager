<?php
// start buffer
ob_start();

// require core functions
require_once(PFM_ROOT_PATH . 'core/functions/debug.php');
require_once(PFM_ROOT_PATH . 'core/functions/array.php');
require_once(PFM_ROOT_PATH . 'core/functions/state.php');
require_once(PFM_ROOT_PATH . 'core/functions/format.php');
require_once(PFM_ROOT_PATH . 'core/functions/url.php');
require_once(PFM_ROOT_PATH . 'core/functions/l10n.php');
require_once(PFM_ROOT_PATH . 'core/functions/router.php');
require_once(PFM_ROOT_PATH . 'core/functions/error.php');
require_once(PFM_ROOT_PATH . 'core/functions/cookie.php');
require_once(PFM_ROOT_PATH . 'core/functions/session.php');

// require main state file
require_once(PFM_ROOT_PATH . 'state.php');

// set default language
l10nSetLang(stateGet('site.lang'));

// initialize localization (l10n)
l10nBindTextDomain('core', 'core/l10n');

// set default text domain
l10nSetTextDomain('main');

// initialize router (modules)
routerInit();

// start session
sessionStart();

// set global error/exception handler
errorHandlerRegister();

// dispatch main request (GET)
routerDispatch($_GET);

// clean and print buffer
ob_end_flush();
