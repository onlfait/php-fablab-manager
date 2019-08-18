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

// Return an local URL with [ http(s)://host(/uri) ]
function pfm_url($uri = null) {
  global $PFM;

  // base url
  $url = 'http';

  // force https ?
  if ($PFM['https']) {
    $url .= 's';
  }

  // add hostname
  $url .= '://' . $PFM['host'];

  // add uri prefix
  if ($uri !== null) {
    $url .= '/' . $uri;
  }

  return $url;
}

// Return an local URL with [ http(s)://host(/?uri=...) ]
function pfm_router_url($uri = null) {
  global $PFM;

  // add uri prefix
  if ($uri !== null) {
    $uri = '?uri=' . $uri;
  }

  return pfm_url($uri);
}

function pfm_print_menu($items, $class = 'menu-item') {
  global $PFM;

  foreach ($items as $key => $value) {
    // If the value is a string, link to route name
    if (is_string($value)) {
      // add selected class
      $_class = $class;
      if ($value === $PFM['route']['uri']) {
        $_class .= ' selected';
      }
      $url = pfm_router_url($value);
      $title = $PFM['routes'][$value]['title'];
      printf('<a class="%s" href="%s">%s</a>', $_class, $url, $title);
    }
  }
}
