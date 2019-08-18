<?php
// Define all routes
$PFM['routes'] = [

  // default route
  '' => [
    'title' => 'Accueil',
    'page'  => 'home/index'
  ],

  // association routes
  'association' => [
    'title' => 'Association',
    'page'  => 'association/index'
  ],

  // contact routes
  'contact' => [
    'title' => 'Contact',
    'page'  => 'contact/index'
  ],

  // events routes
  'events' => [
    'title' => 'Événements / Ateliers',
    'page'  => 'events/index'
  ],

  // members routes
  'members' => [
    'title' => 'Espace membres',
    'page'  => 'members/index'
  ],

  'members/projects' => [
    'title' => 'Projets membres',
    'page'  => 'members/projects'
  ],

  // portfolio routes
  'portfolio' => [
    'title' => 'Portfolio',
    'page'  => 'portfolio/index'
  ],

  // workshop routes
  'workshop' => [
    'title' => 'Espace de travail',
    'page'  => 'workshop/index'
  ],

  // errors routes
  '404' => [
    'title' => 'Erreur 404',
    'page'  => 'errors/404'
  ]

];
