<html>
<head>
<title>config</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?php
//Accès de la BDD
$host = "localhost";
$user = "root";
$pass = "1234";
$bdd = "php-fablab-manager_";

//Nom des tables de la BDD
$TableLogin = "Login";
$TablePw = "Pw";
$TableMembres = "Membres";
$TableProjetPerso="ProjetsPersonnels";

$TableCalendrier="pec_events";
$TableInscrEvent="InscrEvent";
$TableLiaison="Liaison";

$TableAteliers="Ateliers";
$TableSujets="Sujets";
$TableOutils="Outils";


mb_internal_encoding('UTF-8');

//Nom des pages
$NomPage[0]="Home";
$LienPage[0]="https://dev.onlfait.ch/index.php";
$NomPage[1]="Association";
$LienPage[1]="https://dev.onlfait.ch/association.php";
$NomPage[2]="Espace de Travail";
$LienPage[2]="https://dev.onlfait.ch/espaceTravail.php";
$NomPage[3]="Evénements";
$LienPage[3]="https://dev.onlfait.ch/atelier.php";
$NomPage[4]="Projet Membres";
$LienPage[4]="https://dev.onlfait.ch/ProjetMembres.php";
$NomPage[5]="Espace Membres";
$LienPage[5]="https://dev.onlfait.ch/EspaceMembres.php";
$NomPage[6]="Portfolio";
$LienPage[6]="https://dev.onlfait.ch/portfolio.php";
$NomPage[7]="Contact";
$LienPage[7]="https://dev.onlfait.ch/contact.php";

//Jours de fermeture (réservation de machine impossible)
//"lundi","mardi","mercredi","jeudi","vendredi","samedi","dimanche"
$JourFermeture=array("lundi","dimanche");



?>
</body>
</html>
