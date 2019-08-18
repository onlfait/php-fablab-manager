<?php
// Define all routes
$PFM['routes'] = [

  // default route
  '' => [
    'title'  => 'Accueil',
    'page'   => 'home/index',
    'layout' => 'onlfait/default'
  ],

  // association routes
  'association' => [
    'title'  => 'Association',
    'page'   => 'association/index',
    'layout' => 'onlfait/default'
  ],

  // contact routes
  'contact' => [
    'title'  => 'Contact',
    'page'   => 'contact/index',
    'layout' => 'onlfait/default'
  ],

  // events routes
  'events' => [
    'title'  => 'Événements / Ateliers',
    'page'   => 'events/index',
    'layout' => 'onlfait/default'
  ],

  // members routes
  'members' => [
    'title'  => 'Espace membres',
    'page'   => 'members/index',
    'layout' => 'onlfait/default'
  ],

  'members/projects' => [
    'title'  => 'Projets membres',
    'page'   => 'members/projects',
    'layout' => 'onlfait/default'
  ],

  // portfolio routes
  'portfolio' => [
    'title'  => 'Portfolio',
    'page'   => 'portfolio/index',
    'layout' => 'onlfait/default'
  ],

  // workshop routes
  'workshop' => [
    'title'  => 'Espace de travail',
    'page'   => 'workshop/index',
    'layout' => 'onlfait/default'
  ],

  // errors routes
  '404' => [
    'title'  => 'Erreur 404',
    'page'   => 'errors/404',
    'layout' => 'onlfait/default'
  ]

];
