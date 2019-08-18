<?php
// Create the PFM state object (this is the only global)
$PFM = [
  'route' => null,
  'layout' => 'onlfait/default'
];

// Routes
require_once PFM_ROOT_PATH . 'state/routes.php';
