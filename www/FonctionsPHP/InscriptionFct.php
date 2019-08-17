<html>
  <head>
    <title>Inscription</title>
<link href="style.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

<?php

function InscriptionFct($Login,$Pw,$Nom,$Prenom,$Email,$Imprimante,$Laser,$CNC,$Thermo,$CAO) {

	include("config.php");

	//Connexion et requ�te
	mysql_connect($host, $user, $pass) or die("Connexion impossible");
	mysql_select_db($bdd) or die("Connection impossible");
	mysql_query("SET NAMES UTF8");

	$DateInscription = date("y.m.d");
	$EcheanceCoti = date("y.m.d");

    //Stockage dans la bd
	$query = "INSERT INTO $table(Login,Pw,Nom,Prenom,Email,DateInscription,EcheanceCoti,Competences)
    VALUES ('$Login','$Pw','$Nom','$Prenom','$Email','$DateInscription','$EcheanceCoti','$Competences')";
	// Attention les premi�res valeurs sont l'appel des champs (sans apostrophe et $), les secondes sont les valeurs des variables (avec apostrophes et $)
	$result = mysql_query($query);



	mysql_close();
}


function LoginPwSaveFct($Login,$Pw) {

	include("configLogin.php");

	//Connexion et requ�te
	mysql_connect($host, $user, $pass) or die("Connexion impossible");
	mysql_select_db($bdd) or die("Connection impossible");
	mysql_query("SET NAMES UTF8");


    //Stockage dans la bd
	$query = "INSERT INTO $tableLogin(Login) VALUES ('$Login')";
	// Attention les premi�res valeurs sont l'appel des champs (sans apostrophe et $), les secondes sont les valeurs des variables (avec apostrophes et $)
	$result = mysql_query($query);


    //incrément des ancienne ID
    $query = "update $tablePw SET ID = ID + 1";
    $TableLength = mysql_query($query);
    //ID pour la nouvelle entr�e
    $ID = "1";


    //Stockage dans la bd
	$query = "INSERT INTO $tablePw(ID,Pw) VALUES ('$ID','$Pw')";
	// Attention les premières valeurs sont l'appel des champs (sans apostrophe et $), les secondes sont les valeurs des variables (avec apostrophes et $)
	$result = mysql_query($query);


	mysql_close();
}
?>

</body>
</html>
