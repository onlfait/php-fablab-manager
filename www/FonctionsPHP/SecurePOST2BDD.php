<?php 

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
		
		$string = mysqli_real_escape_string($PFM['db']['link'],$string);
		$string = addcslashes($string, '%_');
	}

	return $string;
}
?>
