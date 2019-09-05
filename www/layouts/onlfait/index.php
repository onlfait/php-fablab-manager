<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Onl'Fait - <?php echo $PFM['route']['title'] ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo pfm_url('layouts/onlfait/styles/index.css') ?>">
  </head>
  <body>
    <header>
      <h1 class="title">Onl'Fait</h1>
      <h1 class="subtitle">Apprendre, paratager, s'amuser !</h1>
      <nav>
        <?php pfm_print_menu($PFM['menus']['main']) ?>
      </nav>
    </header>
    <main>
      <?php pfm_require_page($PFM['route']['page']) ?>
    </main>
    <footer>
      Copyleft 2019 - Onl'Fait
    </footer>
    <script src="<?php echo pfm_url('layouts/onlfait/scripts/index.js') ?>"></script>
  </body>
</html>
