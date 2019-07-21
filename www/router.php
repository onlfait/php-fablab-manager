<?php
/**
 * This file is responsible for routing URLs to the pages of the site.
 *
 * ex.: Calling [?page=home] try to load first [./pages/home.php],
 *      if not found try to load [./pages/home/index.php],
 *      if not found load [./pages/404.php]
 *
 * ex.: Calling [?page=member&action=login] try to load [./pages/membre/login.php],
 *      if not found load [./pages/404.php]
 *
 * - The name of the pages and actions must always be lowercase,
 *   and must contain only [a-z], [0-9] and [-_] characters.
 */

// define absolute path to router pages directory
define('ROUTER_PAGES_PATH', ROOT_PATH . ROUTER_PAGES);

// initialize page and action variables
$routerPage = getArrayItem($_GET, 'page', ROUTER_DEFAULT_PAGE);
$routerAction = getArrayItem($_GET, 'action', ROUTER_DEFAULT_ACTION);

// normalize page and action variables
$routerPage = normalizeFilename($routerPage);
$routerAction = normalizeFilename($routerAction);

/**
 * Error 404
 * - send 404 header
 * - include the error 404 page
 * - exit PHP
 * @return [void]
 */
function error404 () {
  // send http 404 header
  http_response_code(404);
  // include page 404
  require(ROUTER_PAGES_PATH . ROUTER_404 . '.php');
  // exit with 404 status
  exit(404);
}

// no action
if (empty($routerAction)) {
  // try to include first [./pages/$routerPage.php]
  if (!includeFile(ROUTER_PAGES_PATH . $routerPage . '.php')) {
    // try to include './pages/$routerPage/index.php'
    if (!includeFile(ROUTER_PAGES_PATH . $routerPage . '/index.php')) {
      // file not found, include './pages/404.php'
      error404();
    }
  }
} else {
  // action provided
  // try to include [./pages/$routerPage/$routerAction.php]
  if (!includeFile(ROUTER_PAGES_PATH . $routerPage . '/' . $routerAction . '.php')) {
    // file not found, include './pages/404.php'
    error404();
  }
}

// exit without error
exit(0);
