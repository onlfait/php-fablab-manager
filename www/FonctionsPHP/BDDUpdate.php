<?php 

include("SecurePOST2BDD.php");

$Variable2Change = securite_bdd($_POST['Variable2Change']);
$NewValue = securite_bdd($_POST['NewValue']);
$IDMembre2Update = securite_bdd($_POST['IDMembre2Update']);

//Connection à la BDD
include("BDDConnect.php");

//Mise à jour des données personnelles
if ($Variable2Change=='NbreHeure'){
  list($heure, $minute, $seconde) = preg_split('[:]', $_SESSION['NbreHeure']);
  $heure=$heure+$NewValue;
  $_SESSION['NbreHeure']=$heure . ":" . $minute . ":" . $seconde;

  //Requête pour mettre à jour le nombre d'heure disponible
  $result = mysqli_query($connect,"UPDATE $TableMembres SET NbreHeure='$_SESSION[NbreHeure]' WHERE ID='$_SESSION[IDLogin]'");

}elseif ($Variable2Change=='EcheanceCoti') {
  if(date_timestamp_get(date_create($_SESSION['EcheanceCoti']))>date_timestamp_get(date_create(date('d-m-Y')))){
    list($annee, $mois, $jour) = preg_split('[-]', $_SESSION['EcheanceCoti']);
  }else{
    list($jour, $mois, $annee) = preg_split('[-]', date('d-m-Y'));
  }
    $_SESSION['EcheanceCoti']=date("Y-m-d", mktime(0, 0, 0, $mois, $jour, $annee+"1"));
    //Requête pour mettre à jour la date d'échéance de la cotisation
    $result = mysqli_query($connect,"UPDATE $TableMembres SET EcheanceCoti='$_SESSION[EcheanceCoti]' WHERE ID='$_SESSION[IDLogin]'");

}elseif ($Variable2Change=='ProjetMembre') {
  $ID = securite_bdd($_POST['ID']);
  $Titre = securite_bdd($_POST['Titre']);
  $Description = securite_bdd($_POST['Description']);

  //Requête pour mettre à jour le nom du projet
  mysqli_query($connect,"UPDATE $TableProjetPerso SET Titre='$Titre' WHERE ID='$ID'");
  mysqli_query($connect,"UPDATE $TableProjetPerso SET Description='$Description' WHERE ID='$ID'");

  //Mise à jour des fichiers images et Zip
  include("Upload.php");
  $NomImage=$ID;
  $dossier = '../Upload/ProjetImage/';
  $extensions = array('.png', '.gif', '.jpg', '.jpeg');
  $MessageImage = UploadImage($dossier,$NomImage,$extensions);

  $dossier = '../Upload/ProjetZip/';
  $NomZip=$ID;
  $extensions = array('.zip');
  $MessageZip = UploadZip($dossier,$NomZip,$extensions);

  if ($MessageZip=='Upload du fichier zip effectué avec succès !'){
    mysqli_query($connect,"UPDATE $TableProjetPerso SET ZipFile='1' WHERE ID='$ID'");
  }

  //Requête pour mettre à jour la table liaison avec les nouveaux outils et sujets
  mysqli_query($connect,"DELETE FROM $TableLiaison WHERE IDProjet='$ID'");
  foreach($_POST as $key => $value){
    if(substr($value,0,6)=='OUTIL_'){
      $Value2Insert=substr($value,6);
      //Requête pour insérer les outils utilisés par le nouveau projet
      $result = mysqli_query($connect,"INSERT INTO $TableLiaison (IDProjet,Outils) VALUES ('$ID','$Value2Insert')");
    }

    if(substr($value,0,6)=='SUJET_'){
      $Value2Insert=substr($value,6);
      //Requête pour insérer les sujets utilisés par le nouveau projet
      $result = mysqli_query($connect,"INSERT INTO $TableLiaison (IDProjet,Sujets) VALUES ('$ID','$Value2Insert')");
    }
  }
}elseif ($Variable2Change=='DonneeMembre') {
  $Password = securite_bdd($_POST['Password']);
  $Nom = securite_bdd($_POST['Nom']);
  $Prenom = securite_bdd($_POST['Prenom']);
  $Email = securite_bdd($_POST['Email']);
  //Requête pour mettre à jour les données des membres
  mysqli_query($connect,"UPDATE $TableLogin SET Pw='$Password' WHERE ID='$_SESSION[IDLogin]'");
  mysqli_query($connect,"UPDATE $TableMembres SET Nom='$Nom' WHERE ID='$_SESSION[IDLogin]'");
  mysqli_query($connect,"UPDATE $TableMembres SET Prenom='$Prenom' WHERE ID='$_SESSION[IDLogin]'");
  mysqli_query($connect,"UPDATE $TableMembres SET Email='$Email' WHERE ID='$_SESSION[IDLogin]'");
  $checked=0;
  foreach($_POST as $key => $value){
    if($value=='Newsletter'){
      //Requête pour insérer l'inscription à la Newsletter
      $checked=1;
    }
  }
  mysqli_query($connect,"UPDATE $TableMembres SET Newsletter='$checked' WHERE ID='$_SESSION[IDLogin]'");

  //Requête pour mettre à jour la table liaison avec les nouveaux outils et sujets
  mysqli_query($connect,"DELETE FROM $TableLiaison WHERE IDMembre='$_SESSION[IDLogin]'");
  foreach($_POST as $key => $value){
    if(substr($value,0,6)=='OUTIL_'){
      $Value2Insert=substr($value,6);
      //Requête pour insérer les nouveaux outils utilisés par le membre
      $result = mysqli_query($connect,"INSERT INTO $TableLiaison (IDMembre,Outils) VALUES ('$_SESSION[IDLogin]','$Value2Insert')");
    }

    if(substr($value,0,6)=='SUJET_'){
      $Value2Insert=substr($value,6);
      //Requête pour insérer les nouveaux sujets utilisés par le membre
      $result = mysqli_query($connect,"INSERT INTO $TableLiaison (IDMembre,Sujets) VALUES ('$_SESSION[IDLogin]','$Value2Insert')");
    }
  }
}elseif ($Variable2Change=='DonneeMembreByAdmin') {
  $IDMembre = securite_bdd($_POST['IDMembre']);
  $EcheanceCoti = securite_bdd($_POST['EcheanceCoti']);
  $NbreHeure = securite_bdd($_POST['NbreHeure']);
  $AdminMembre = securite_bdd($_POST['AdminMembre']);

  //Requête pour mettre à jour les données des membres
  mysqli_query($connect,"UPDATE $TableMembres SET EcheanceCoti='$EcheanceCoti' WHERE ID='$IDMembre'");
  mysqli_query($connect,"UPDATE $TableMembres SET NbreHeure='$NbreHeure' WHERE ID='$IDMembre'");
  mysqli_query($connect,"UPDATE $TableMembres SET AdminMembre='$AdminMembre' WHERE ID='$IDMembre'");

}elseif ($Variable2Change=='Event') {
  $IDEvent = securite_bdd($_POST['IDEvent']);
  $Titre = securite_bdd($_POST['Titre']);
  $HeureDebut = securite_bdd($_POST['HeureDebut']);
  $HeureFin = securite_bdd($_POST['HeureFin']);
  $Description = securite_bdd($_POST['Description']);
  $Age = securite_bdd($_POST['Age']);
  $PrixMembre = securite_bdd($_POST['PrixMembre']);
  $PrixNonMembre = securite_bdd($_POST['PrixNonMembre']);

  //Requête pour mettre à jour l'event
  mysqli_query($connect,"UPDATE $TableEvent SET Titre='$Titre' WHERE NoEvent='$IDEvent'");
  mysqli_query($connect,"UPDATE $TableEvent SET HeureDebut='$HeureDebut' WHERE NoEvent='$IDEvent'");
  mysqli_query($connect,"UPDATE $TableEvent SET HeureFin='$HeureFin' WHERE NoEvent='$IDEvent'");
  mysqli_query($connect,"UPDATE $TableEvent SET Description='$Description' WHERE NoEvent='$IDEvent'");
  mysqli_query($connect,"UPDATE $TableEvent SET Age='$Age' WHERE NoEvent='$IDEvent'");
  mysqli_query($connect,"UPDATE $TableEvent SET PrixMembre='$PrixMembre' WHERE NoEvent='$IDEvent'");
  mysqli_query($connect,"UPDATE $TableEvent SET PrixNonMembre='$PrixNonMembre' WHERE NoEvent='$IDEvent'");

  //Mise à jour des fichiers images
  include("Upload.php");
  $NomImage=$IDEvent;
  $dossier = '../Upload/EventImage/';
  $extensions = array('.png', '.gif', '.jpg', '.jpeg');
  $MessageImage = UploadImage($dossier,$NomImage,$extensions);

  //Requête pour mettre à jour la table liaison avec les nouveaux outils et sujets
  mysqli_query($connect,"DELETE FROM $TableLiaison WHERE IDEvent='$IDEvent'");
  foreach($_POST as $key => $value){
    if(substr($value,0,8)=='ATELIER_'){
      $Value2Insert=substr($value,8);
      //Requête pour insérer les atliers utilisés par l'évenement
      $result = mysqli_query($connect,"INSERT INTO $TableLiaison (IDEvent,Ateliers) VALUES ('$IDEvent','$Value2Insert')");
    }

    if(substr($value,0,6)=='OUTIL_'){
      $Value2Insert=substr($value,6);
      //Requête pour insérer les outils utilisés par l'évéenement
      $result = mysqli_query($connect,"INSERT INTO $TableLiaison (IDEvent,Outils) VALUES ('$IDEvent','$Value2Insert')");
    }

    if(substr($value,0,6)=='SUJET_'){
      $Value2Insert=substr($value,6);
      //Requête pour insérer les sujets utilisés par l'évenement
      $result = mysqli_query($connect,"INSERT INTO $TableLiaison (IDEvent,Sujets) VALUES ('$IDEvent','$Value2Insert')");
    }
  }
}




//Fermeture de BDD
mysqli_close($connect);


?>




<!-- Page de confirmation-->
<html>
<head>
  <title>Mise à jour de la Base de Donnée</title>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<?php
include("entete.php");
include("menu.php");
?>

<div id="content" >
  <div id="centercolumn">

    <?php if($Variable2Change=='Nom' OR $Variable2Change=='Prenom' OR $Variable2Change=='Email' OR substr($Variable2Change,0,4)=='Comp'){ ?>
      <p class="SousSousTitreC">Confirmation de modification</p>
      <p class="TexteC">Vos données personnelles ont été modifiées</p>
    <?php }elseif($Variable2Change=='NbreHeure'){ ?>
      <p class="SousSousTitreC">Confirmation d'achat</p>
      <p class="TexteC">L'achat de votre nouveau paquet d'heure a été ajouté à votre compte</p>
    <?php }elseif($Variable2Change=='EcheanceCoti'){ ?>
      <p class="SousSousTitreC">Confirmation d'achat</p>
      <p class="TexteC">Le payement de votre cotisation annuelle a été pris en comte</p>
    <?php }elseif($Variable2Change=='ProjetMembre'){ ?>
      <p class="SousSousTitreC">Confirmation de modification</p>
      <p class="TexteC">Les modifications de votre projet ont été prises en comte</p>
    <?php }elseif($Variable2Change=='DonneeMembre'){ ?>
      <p class="SousSousTitreC">Confirmation de modification</p>
      <p class="TexteC">Les modifications de vos donnees membres ont été prises en comte</p>
    <?php }elseif($Variable2Change=='DonneeMembreByAdmin'){ ?>
      <p class="SousSousTitreC">Confirmation de modification</p>
      <p class="TexteC">Les modifications des données du membre ont été prises en comte</p>
    <?php }elseif($Variable2Change=='Event'){ ?>
      <p class="SousSousTitreC">Confirmation de modification</p>
      <p class="TexteC">Les modifications de l'événement ont été prises en comte</p>
    <?php } ?>

    <form action="../EspaceMembres.php">
      <td class="TexteCentre"><input type="submit" value="Retour Espace Membres" size=20></td>
    </form>


  </div><!-- #centercolumn -->
</div><!-- #content -->

<?php include("pied_de_page.php"); ?>

</body>
</html>
