<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <title><?php echo(SITE_NAME); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php printURL('layout/styles/bulma.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php printURL('layout/styles/layout.css'); ?>">
  </head>
  <body>
    <nav class="main-navbar navbar has-shadow is-spaced" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <?php echo file_get_contents(siteURL('layout/images/logo.svg')); ?>
        <?php printLink('', SITE_NAME, 'home-link navbar-item'); ?>
      </div>
    </nav>
    <div class="main-container container">
