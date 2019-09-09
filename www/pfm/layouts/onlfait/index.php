<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Onl'Fait - <?php echo $PFM['route']['title'] ?></title>
    <link rel="stylesheet" href="<?php echo pfm_layout_url('onlfait/styles/index.css') ?>">
  </head>
  <body>
    <header>
      <nav class="menu">
        <?php pfm_print_menu($PFM['menus']['main']) ?>
      </nav>
    </header>
    <main>
      <?php pfm_require_page($PFM['route']['page']) ?>
    </main>
    <footer>
      <p class="text-center">
        <strong>PHP FabLab Manager</strong> par <a href="<?php echo pfm_url() ?>">Onl'Fait</a>.
        Le code source est sous licence <a href="http://opensource.org/licenses/mit-license.php">MIT</a>.
        Le contenu du site est sous licence <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
      </p>
    </footer>
    <script src="<?php echo pfm_layout_url('onlfait/scripts/index.js') ?>"></script>
  </body>
</html>
