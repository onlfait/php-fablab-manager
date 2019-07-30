<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <title><?php statePrint('site.title') ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo(routerFileURL('layout/styles/bulma.min.css')) ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo(routerFileURL('layout/styles/layout.css')) ?>">
  </head>
  <body>
    <nav class="main-navbar navbar has-shadow is-danger" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a href="<?php echo(url('')) ?>" class="navbar-item" title="<?php textPrint('Go to the home page') ?>">
          <?php echo file_get_contents(routerFileURL('layout/images/logo.svg')) ?>
          <strong><?php statePrint('site.title') ?></strong>
        </a>
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>
      <div class="navbar-menu">
        <div class="navbar-start">
          ...
        </div>
        <div class="navbar-end">
          <div class="navbar-item">
            <div class="buttons">
              <a class="button is-dark">
                <strong><?php textPrint('Sign up') ?></strong>
              </a>
              <a class="button is-light">
                <?php textPrint('Log in') ?>
              </a>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <div class="main-container container">
