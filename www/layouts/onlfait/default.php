<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Onl'Fait - <?php echo $PFM['route']['title'] ?></title>
    <link rel="stylesheet" href="./layouts/onlfait/default.css">
  </head>
  <body>
    <header>
      <h1 class="title">FabLab On l'Fait</h1>
      <p class="subtitle">Apprendre, Partager, s'Amuser!</p>
    </header>
    <nav>
      <?php pfm_print_menu($PFM['menus']['main']) ?>
    </nav>
    <?php pfm_require_page($PFM['route']['page']) ?>
    <script src="./layouts/onlfait/default.js"></script>
  </body>
</html>
