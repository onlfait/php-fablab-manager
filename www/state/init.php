<?php
// Create the PFM state object (this is the only global)
$PFM = [
  'route'  => null,
  'layout' => 'onlfait/default',
  'host'   => 'localhost',
  'https'  => false
];

// Require all state files
require_once PFM_ROOT_PATH . 'state/routes.php';
require_once PFM_ROOT_PATH . 'state/menus.php';
