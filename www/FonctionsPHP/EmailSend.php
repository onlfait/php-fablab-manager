<?php session_start();

include("SecurePOST2BDD.php");

$WhichEmail=securite_bdd($_POST['WhichEmail']);

if($WhichEmail=="InfoGenerale"){
	$Titre=$_POST['Titre'];
	$InfoPrincipale = $_POST['InfoPrincipale'];
	$SousChap=$_POST['SousChap'];
	$TitreSousChap=$_POST['TitreSousChap'];

	include("Upload.php");
	$NomImage= time();
	$dossier = '../Upload/EmailTemp/';
	$extensions = array('.jpg');
	$MessageImage = UploadImage($dossier,$NomImage,$extensions);

	//=====Définition du sujet.
	$sujet = $Titre;
	//=========

	include("BDDConnect.php");
	$result = mysqli_query($connect,"SELECT Email FROM $TableMembres");
	//$mail = 'sebastienthomas001@gmail.com'; // Déclaration de l'adresse de destination.

	//=====Déclaration des messages au format texte et au format HTML.
	$message_html = "<html><head></head><body>";
	$message_html .= "<center><img src='https://dev.onlfait.ch/Image/Logo/OnLFait.jpg' alt='Logo'></center><br/>";
	$message_html .= "<font size='6'><center><b>" . $Titre . "</b></center></font><br/>";
	$message_html .= "<img src='https://dev.onlfait.ch/Upload/EmailTemp/" . strval($NomImage) . ".jpg' width='150'><br/>";
	$message_html .= nl2br($InfoPrincipale) . "<br/><br/>";
	$message_html .= "<font size='4'><b>" . $TitreSousChap . "</a></b></font><br/>";
	$message_html .= nl2br($SousChap) . "<br/><br/>";
	//==========
}



if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}

//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========

//=====Création du header de l'e-mail.
//$header = "From: \"WeaponsB\"<weaponsb@mail.fr>".$passage_ligne;
//$header.= "Reply-to: \"WeaponsB\" <weaponsb@mail.fr>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========

//=====Envoi de l'e-mail.
while($EmailArray = mysqli_fetch_array($result))
{
	$mail=$EmailArray["Email"];
	mail($mail,$sujet,$message,$header);
}

//==========

//Effacement de l'image du serveur sauvée temporairement pour l'envoi de l'email
//unlink("../Upload/EmailTemp/" . $NomImage . ".jpg");
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

    <?php if($WhichEmail=="InfoGenerale"){ ?>
      <p class="SousSousTitreC">Confirmation d'envoi</p>
			<p class="TexteC">L'info générale a été envoyée</p>
      <?php
     } ?>

    <form action="../EspaceMembres.php">
      <td class="TexteCentre"><input type="submit" value="Retour Espace Membres" size=20></td>
    </form>


  </div><!-- #centercolumn -->
</div><!-- #content -->

<?php include("pied_de_page.php"); ?>

</body>
</html>
