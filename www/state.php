<?php
stateSet('site', [
  'title' => 'PHP Fablab Manager',
  'host' => 'localhost/',
  'https' => false,
  'lang' => 'fr'
]);

stateSet('modules', [
  'names' => ['errors', 'main']
]);

stateSet('router', [
  'defaults' => [
    'page' => 'home',
    'action' => 'index'
  ]
]);
