<?php
// require a file from the root path
function pfm_require_file($file) {
  global $PFM;
  require PFM_ROOT_PATH . $file . '.php';
}

// require a page from pages directory
function pfm_require_page($file) {
  pfm_require_file('pages/' . $file);
}

// require a layout from layouts directory
function pfm_require_layout($file) {
  pfm_require_file('layouts/' . $file);
}

// Dispatch requested route
function pfm_dispatch_route($request) {
  global $PFM;

  // Default route
  $uri = '';

  // Get the requested route
  if (!empty($request['uri'])) {
    $uri = trim($request['uri']);
  }

  // If the route does not exists
  if (!isset($PFM['routes'][$uri])) {
    $uri = '404';
  }

  // Update state
  $PFM['route'] = $PFM['routes'][$uri];
  $PFM['route']['uri'] = $uri;

  // Get the default layout
  $layout = $PFM['layout'];

  // Get optional route layout
  if (!empty($PFM['route']['layout'])) {
    $layout = $PFM['route']['layout'];
  }

  // Include the page layout
  pfm_require_layout($layout);
}
