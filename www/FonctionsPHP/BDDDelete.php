<?php 

include("SecurePOST2BDD.php");

$DeleteWhat = securite_bdd($_POST['DeleteWhat']);

//Connection à la BDD
include("BDDConnect.php");

if($DeleteWhat=="DeleteOutil"){

  $DeleteOutilName = securite_bdd($_POST['DeleteOutilName']);

  //Requête pour voir si l'outil à effacer existe
  $query = mysqli_query($connect,"SELECT * FROM $TableOutils WHERE OutilName='$DeleteOutilName'");
  $NbreRow=mysqli_affected_rows($connect);

  $Array = mysqli_fetch_array($query);
  $OutilVariableName = $Array['OutilVariableName'];

  if($NbreRow==0){
    $message="L'outil n'existe pas";
  }else{
    //Requête pour effacer un outils
    $result = mysqli_query($connect,"DELETE FROM $TableOutils WHERE OutilName='$DeleteOutilName'");
    $result = mysqli_query($connect,"DELETE FROM $TableLiaison WHERE Outils='$OutilVariableName'");

    unlink('../Image/Picto/Outil_' . $OutilVariableName . ".png");
    $message="Effacement de l'outil effectué";
  }

}elseif($DeleteWhat=="DeleteSujet"){

  $DeleteSujetName = securite_bdd($_POST['DeleteSujetName']);

  //Requête pour voir si le sujet à effacer existe
  $query = mysqli_query($connect,"SELECT * FROM $TableSujets WHERE SujetName='$DeleteSujetName'");
  $NbreRow=mysqli_affected_rows($connect);

  $Array = mysqli_fetch_array($query);
  $SujetVariableName = $Array['SujetVariableName'];

  if($NbreRow==0){
    $message="Le sujet n'existe pas";
  }else{
    //Requête pour effacer un sujet
    $result = mysqli_query($connect,"DELETE FROM $TableSujets WHERE SujetName='$DeleteSujetName'");
    $result = mysqli_query($connect,"DELETE FROM $TableLiaison WHERE Sujets='$SujetVariableName'");

    unlink('../Image/Picto/Sujet_' . $SujetVariableName . ".png");
    $message="Effacement du sujet effectué";
  }

}elseif($DeleteWhat=="DeleteAtelier"){

  $DeleteAtelierName = securite_bdd($_POST['DeleteAtelierName']);

  //Requête pour voir si l'outil à effacer existe
  $query = mysqli_query($connect,"SELECT * FROM $TableAteliers WHERE AtelierName='$DeleteAtelierName'");
  $NbreRow=mysqli_affected_rows($connect);

  $Array = mysqli_fetch_array($query);
  $AtelierVariableName = $Array['AtelierVariableName'];

  if($NbreRow==0){
    $message="L'Atelier n'existe pas";
  }else{
    //Requête pour effacer un atelier
    $result = mysqli_query($connect,"DELETE FROM $TableAteliers WHERE AtelierName='$DeleteAtelierName'");
    $result = mysqli_query($connect,"DELETE FROM $TableLiaison WHERE Ateliers=$AtelierVariableName");

    unlink("../Image/Picto/Atelier_" . $AtelierVariableName . ".png");
    $message="Effacement du Atelier effectué";
  }

}elseif($DeleteWhat=="ZipFile"){

  $ID = securite_bdd($_POST['ID']);
  unlink("../Upload/ProjetZip/" . $ID . ".zip");
  mysqli_query($connect,"UPDATE $TableProjetPerso SET ZipFile='0' WHERE ID='$ID'");
  $message="Effacement du fichier Zip effectué";

}elseif($DeleteWhat=="Membre"){

  $IDMembre = securite_bdd($_POST['IDMembre']);
  //Requête pour effacer un atelier
  $result = mysqli_query($connect,"DELETE FROM $TableMembres WHERE ID='$IDMembre'");
  $result = mysqli_query($connect,"DELETE FROM $TableLiaison WHERE IDMembre='$IDMembre'");
  $result = mysqli_query($connect,"DELETE FROM $TableLogin WHERE ID='$IDMembre'");
  $message="Effacement du membre des bases de données effectué";

}elseif($DeleteWhat=="ReservationMachine"){

  $NumeroReservationMachine = securite_bdd($_POST['NumeroReservationMachine']);

  if(substr($Subject,6)!="FabLab"){
    //Requête pour connaitre le nombre d'heure à rembourser et la date de réservation
    $result = mysqli_query($connect,"SELECT start_date, start_timestamp, end_timestamp FROM $TableCalendrier WHERE id='$NumeroReservationMachine'");
    $row = mysqli_fetch_array($result);

    if(date_timestamp_get(date_create($row['start_date']))>(24*3600)+date_timestamp_get(date_create(date('d-m-Y')))){
      list($heure, $minute, $seconde) = preg_split('[:]', $_SESSION['NbreHeure']);
      $NbreHeureTS=($heure*3600)+($minute*60)+$seconde+($row['end_timestamp']-$row['start_timestamp']);
      list($heure, $minute, $seconde) = preg_split('[:]',date("h:i:s",$NbreHeureTS));
      $heure=$heure-1;
      $_SESSION['NbreHeure']=$heure . ":" . $minute . ":" . $seconde;

      //Requête pour updater les heures disponibles du membre qui a annulé la réservaation plus de 24h avant
      $result = mysqli_query($connect,"UPDATE $TableMembres SET NbreHeure='$_SESSION[NbreHeure]' WHERE ID='$_SESSION[IDLogin]'");
    }
  }
  //Requête pour effacer la réservation
  $result = mysqli_query($connect,"DELETE FROM $TableCalendrier WHERE id='$NumeroReservationMachine'");

  $message="La réservation a été annulée";

}elseif($DeleteWhat=="ProjetMembre"){

  $ID = securite_bdd($_POST['IDProjet']);
  $ZipFile = securite_bdd($_POST['ZipFile']);

  if($ZipFile==1){
    unlink("../Upload/ProjetZip/" . $ID . ".zip");
  }
  unlink("../Upload/ProjetImage/" . $ID . ".jpg");
  $result = mysqli_query($connect,"DELETE FROM $TableProjetPerso WHERE ID='$ID'");
  $result = mysqli_query($connect,"DELETE FROM $TableLiaison WHERE IDProjet='$ID'");

  $message="La projet a été supprimé";

}elseif($DeleteWhat=="Event"){

  $ID = securite_bdd($_POST['IDEvent']);

  unlink("../Upload/EventImage/" . $ID . ".jpg");
  $result = mysqli_query($connect,"DELETE FROM $TableEvent WHERE NoEvent='$ID'");
  $result = mysqli_query($connect,"DELETE FROM $TableLiaison WHERE IDEvent='$ID'");

  $message="L'événements' a été supprimé";
}


//Fermeture de BDD
mysqli_close($connect);
?>





<!-- Page de confirmation-->
<html>
<head>
  <title>Confirmation</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<?php
include("entete.php");
include("menu.php");
?>

<div id="content" >
  <div id="centercolumn">
    <?php DeleteInBDD($message);?>
  </div><!-- #centercolumn -->
</div><!-- #content -->

<?php include("pied_de_page.php"); ?>

</body>
</html>


<?php
function DeleteInBDD($message){ ?>
  <p class="SousSousTitreC">Confirmation de suppression</p>
  <p class="TexteC"><?php echo $message ?></p>

  <form action="../EspaceMembres.php">
    <td class="TexteCentre"><input type="submit" value="Retour Espace Membres" size=20></td>
  </form>
  <?php
}
