<?php
/**
 * This file is responsible for routing URLs to the pages of the site.
 *
 * ex.1: Calling [?page=members] try to load first [./modules/[*]/pages/members/index.php],
 *       if not found try to load [./modules/[*]/pages/errors/404.php]
 *       if not found finally print a basic 404 Not Found page
 *
 * ex.2: Calling [?page=members&action=login] try to load first [./modules/[*]/pages/members/login.php],
 *       if not found try to load [./modules/[*]/pages/errors/404.php]
 *       if not found finally print a basic 404 Not Found page
 *
 * [*] for each initialized module
 *
 * - The name of the pages and actions must always be lowercase,
 *   and must contain only [a-z], [0-9] and [-_] characters.
 */

// initialize all modules
function routerInit () {
  // singleton function
  static $done = false;
  if ($done) return;
  $done = true;
  // init empty modules paths
  $paths = [];
  // for each modules
  foreach (stateGet('modules.names', []) as $name) {
    $path = PFM_ROOT_PATH . 'modules/' . $name . '/';
    $l10n = 'modules/' . $name . '/l10n/';
    $init = $path . 'init.php';
    if (!is_dir($path)) {
      trigger_error(text('core', 'Module not found: %s', [$path]), E_USER_WARNING);
      continue;
    }
    // initialize module
    if (is_file($init)) {
      require_once($init);
    }
    // initialize l10n
    if (is_dir(PFM_ROOT_PATH . $l10n)) {
      l10nBindTextDomain($name, $l10n);
    }
    // add module path at first place
    array_unshift($paths, $path);
  }
  stateSet('modules.paths', $paths);
}

// return first file found in modules paths
function routerFindFile (string $file) {
  foreach (stateGet('modules.paths', []) as $path) {
    if (is_file($path . $file)) {
      return $path . $file;
    }
  }
  return false;
}

// include first file found in modules paths
function routerInclude (string $file, string $ext = '.php', bool $warn = true) {
  $path = routerFindFile($file . $ext);
  if ($path) {
    include($path);
    return true;
  }
  if ($warn) {
    trigger_error(text('core', 'File not found: %s', [$file . $ext]), E_USER_WARNING);
  }
  return false;
}

// include first page/action found in modules paths
function routerIncludePage (string $page, string $action, bool $warn = null) {
  return routerInclude('pages/' . $page . '/' . $action, '.php', $warn);
}

// display an error page from modules paths or a static one if none found
function routerError (int $code, string $title = null, string $message = null) {
  http_response_code($code);
  if (!routerIncludePage('errors', $code, false)) {
    if ($title === null) {
      $title = 'Error ' . $code;
    }
    echo('<!DOCTYPE html><html><head><meta charset="utf-8"><title>' . $title . '</title></head><body><h1>' . $title . '</h1>');
    if ($message !== null) {
      echo('<p>' . $message . '</p>');
    }
    echo('</body></html>');
  }
  exit($code);
}

// error 404 shortcuts
function routerError404 (string $title = null, string $message = null) {
  routerError(404, $title, $message);
}

// error 500 shortcuts
function routerError500 (string $title = null, string $message = null) {
  routerError(500, $title, $message);
}

// dispatch request
function routerDispatch (array $route) {
  // initialize page and action variables
  $page = arrayGet($route, 'page', stateGet('router.defaults.page'));
  $action = arrayGet($route, 'action', stateGet('router.defaults.action'));
  // normalize page and action variables
  $page = formatFilename($page);
  $action = formatFilename($action);
  // update state
  stateSet('router.current.page', $page);
  stateSet('router.current.action', $action);
  stateSet('router.requested.page', $page);
  stateSet('router.requested.action', $action);
  // try to include the page
  if (!routerIncludePage($page, $action, false)) {
    stateSet('router.current.page', 'errors');
    stateSet('router.current.action', '404');
    routerError404(
      text('core', 'Error 404 - Page Not Found'),
      text('core', 'The requested page [%s/%s] was not found on this server.', [$page, $action])
    );
  }
}

function routerFileURL (string $file) {
  $moduleFile = routerFindFile($file);
  if ($moduleFile) {
    $file = str_replace(PFM_ROOT_PATH, '', $moduleFile);
  }
  return url($file);
}
