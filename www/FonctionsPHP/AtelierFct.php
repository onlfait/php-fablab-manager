<html>
<head>
  <title>Inscription</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

  <?php
  include("entete.php");
  include("menu.php");


  include("SecurePOST2BDD.php");
  $Nom = securite_bdd($_POST['Nom']);
  $Prenom = securite_bdd($_POST['Prenom']);
  $Email = securite_bdd($_POST['Email']);
  $NoEvent = securite_bdd($_POST['NoEvent']);
  $Titre = securite_bdd($_POST['Titre']);
  $Lieu = securite_bdd($_POST['Lieu']);
  $HeureDebut = securite_bdd($_POST['HeureDebut']);
  $HeureFin = securite_bdd($_POST['HeureFin']);
  ?>

  <div id="content" >
    <div id="centercolumn">

      <p class="SousSousTitreC">Confirmation de l'inscription</p>

      <p class="TexteC">L'inscription est enregistrée et un email vous a été envoyé</p>
      <?php
      //Connection à la BDD
      include("BDDConnect.php");

      //Requête pour insérer l'inscription à l'événement dans la BDD
      $result = mysqli_query($connect,"INSERT INTO $TableInscrEvent(NoEvent,Nom,Prenom,Email) VALUES ('$NoEvent','$Nom','$Prenom','$Email')");

      //Requête pour mettre à jour le nombre de place disponible
      $result = mysqli_query($connect,"SELECT * FROM $TableEvent WHERE NoEvent='$NoEvent'");
      $Array=mysqli_fetch_array($result);
      $PlaceDispoUpdate = $Array["PlaceDispo"];
      $PlaceDispoUpdate = $PlaceDispoUpdate - 1;
      $result = mysqli_query($connect,"UPDATE $TableEvent SET PlaceDispo='$PlaceDispoUpdate' WHERE NoEvent='$NoEvent'");

      //Envoi email Confirmation
      include("EmailSendFunctions.php");
      EmailInscriptionEvent($Nom,$Prenom,$Email,$Titre,$Lieu,$HeureDebut,$HeureFin);
      $message="L'inscription est enregistrée, un email vous a été envoyé";


      //Fermeture de BDD
      mysqli_close($connect);
      ?>

      <form action="../atelier.php">
        <td class="TexteCentre"><input type="submit" value="Retour Ateliers" size=20></td>
      </form>

    </div><!-- #centercolumn -->
  </div><!-- #content -->




  ?>

</body>
</html>
