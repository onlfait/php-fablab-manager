<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <title><?php statePrint('site.title') ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo(routerFileURL('layout/styles/bulma.min.css')) ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo(routerFileURL('layout/styles/layout.css')) ?>">
    <script src="https://kit.fontawesome.com/b8646eefa3.js"></script>
  </head>
  <body>
    <nav class="main-navbar navbar has-shadow is-danger" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a href="<?php echo(url('')) ?>" class="navbar-item" title="<?php textPrint('Go to the home page') ?>">
          <?php echo file_get_contents(routerFileURL('layout/images/logo.svg')) ?>
          <strong><?php statePrint('site.title') ?></strong>
        </a>
        <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>
      <div class="navbar-menu" id="navMenu">
        <div class="navbar-start">
          <?php printNavBarMenu(stateGet('main.menus.header')) ?>
        </div>
        <div class="navbar-end">

          <?php if (userConnected()) { ?>

          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
              <span class="icon">
                <i class="fas fa-user-circle"></i>
              </span>
            </a>
            <div class="navbar-dropdown is-right">
              <div class="navbar-item">
                <?php sessionPrint('user.email') ?>
              </div>
              <hr class="navbar-divider">
              <a class="navbar-item">
                <?php textPrint('Your profile') ?>
              </a>
              <a class="navbar-item">
                <?php textPrint('Your projects') ?>
              </a>
              <a class="navbar-item">
                <?php textPrint('Your bookings') ?>
              </a>
              <hr class="navbar-divider">
              <a class="navbar-item">
                <?php textPrint('Settings') ?>
              </a>
              <a class="navbar-item" href="<?php echo routerURL('members', 'log-out') ?>">
                <?php textPrint('Log out') ?>
              </a>
            </div>
          </div>

          <?php } else { ?>

          <div class="navbar-item">
            <div class="buttons">
              <a class="button is-dark" href="<?php echo routerURL('members', 'sign-up') ?>">
                <strong><?php textPrint('Sign up') ?></strong>
              </a>
              <a class="button is-light" href="<?php echo routerURL('members', 'log-in') ?>">
                <?php textPrint('Log in') ?>
              </a>
            </div>
          </div>

          <?php } ?>

        </div>
      </div>
    </nav>
    <div class="main-container container">
