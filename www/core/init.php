<?php
// require core functions
require_once(PFM_ROOT_PATH . 'core/functions/debug.php');
require_once(PFM_ROOT_PATH . 'core/functions/array.php');
require_once(PFM_ROOT_PATH . 'core/functions/state.php');
require_once(PFM_ROOT_PATH . 'core/functions/format.php');
require_once(PFM_ROOT_PATH . 'core/functions/url.php');
require_once(PFM_ROOT_PATH . 'core/functions/l10n.php');
require_once(PFM_ROOT_PATH . 'core/functions/router.php');

// require main state file
require_once(PFM_ROOT_PATH . 'state.php');

// set default language
l10nSetLang(stateGet('site.lang'));

// initialize localization (l10n)
l10nBindTextDomain('core', 'core/l10n');

// initialize router (modules)
routerInit();

// dispatch main request (GET)
routerDispatch($_GET);

// DEBUG state
debugVar($_PFM);
