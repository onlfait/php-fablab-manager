<?php
// Create the PFM state object (this is the only global)
$PFM = [
  'route'  => null,
  'layout' => 'onlfait/index',
  'host'   => 'localhost',
  'https'  => false
];

// Require all state files
require_once PFM_PATH . 'state/routes.php';
require_once PFM_PATH . 'state/menus.php';
require_once PFM_PATH . 'state/db.php';
