<?php
require_once(PFM_ROOT_PATH . 'modules/main/functions/layout.php');
require_once(PFM_ROOT_PATH . 'modules/main/functions/user.php');

stateSet('main', [
  'menus' => [
    'header' => [
      text('Workspace') => [
        text('Equipments') => ['page' => 'workspace', 'action' => 'equipments'],
        text('Booking') => ['page' => 'workspace', 'action' => 'booking']
      ],
      text('Projects') => ['page' => 'projects'],
      text('Members') => ['page' => 'members'],
      text('Events') => ['page' => 'events'],
      text('Contact') => ['page' => 'contact'],
      text('About') => ['page' => 'about']
    ]
  ]
]);
