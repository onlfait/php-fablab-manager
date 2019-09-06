<?php


session_destroy();
?>

<html>
<head>
  <title>Espace Membre Perso</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>

  <?php include("entete.php"); ?>
  <?php include("menu.php"); ?>

  <div id="content" >
    <div id="centercolumn">

      <p class="SousTitreC"> Espace Membre Perso </p>
      <p class="TexteC"> Vos données de connexion ne sont pas correct ou votre session a été fermée </p>
      <form action="../EspaceMembres.php" method="post">
        <td><input name="submit1" type="submit" value="Retour à la page de connexion" size=10></td>
      </form>

  </div><!-- #centercolumn -->
  </div><!-- #content -->

  <?php include("pied_de_page.php"); ?>

</body>
</html>
