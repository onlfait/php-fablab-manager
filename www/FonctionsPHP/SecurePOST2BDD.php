<?php session_start();

function securite_bdd($string)
{
	// On regarde si le type de string est un nombre entier (int)
	if(ctype_digit($string))
	{
		$string = intval($string);
	}
	// Pour tous les autres types
	else
	{
		include("BDDConnect.php");
		$string = mysqli_real_escape_string($connect,$string);
		$string = addcslashes($string, '%_');
	}

	return $string;
}
?>
