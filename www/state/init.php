<?php
// Create the PFM state object (this is the only global)
$PFM = [
  'route' => null
];

// Routes
require_once PFM_ROOT_PATH . 'state/routes.php';
