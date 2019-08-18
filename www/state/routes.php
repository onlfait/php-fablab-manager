<?php
// Define all routes
$PFM['routes'] = [

  // default route
  '' => [
    'title'  => 'Accueil',
    'page'   => 'home/index',
    'layout' => 'onlfait/default'
  ],

  // error 404
  '404' => [
    'title'  => 'Erreur 404',
    'page'   => 'errors/404',
    'layout' => 'onlfait/default'
  ]

];
