<?php 

function EmailNouveauMembre($IDMembre,$Nom,$Prenom,$Email,$Login){

	//=====Définition du sujet.
	$sujet = "Nouveau membre";
	//=========

	$mail = $Email; // Déclaration de l'adresse de destination.

	//=====Déclaration des messages au format texte et au format HTML.
	$message_html = "<html><head></head><body>";
	$message_html .= "<center><img src='https://dev.onlfait.ch/Image/Logo/OnLFait.jpg' alt='Logo'></center><br/>";
	$message_html .= "<font size='6'><center><b>Bienvenue</b></center></font><br/>";
	$message_html .= "Bonjour " . $Prenom . " " . $Nom . "," . "<br/><br/>";
	$message_html .= "Votre insciption en tant que membre du Fablab On l'fait a été correctement enregistré <br/><br/>";
	$message_html .= "Vous pouvez dorénavant vous connectez à l'aide de votre login: " . $Login . " et de votre mot de passe <br/><br/>";
	$message_html .= "<br/>";
	$message_html .= "Ceci est un email automatique, merci de ne pas y répondre<br/>";
	$message_html .= "<br/>";
	$message_html .= "L'équipe du Fablab Onl'fait<br/>";

	Email($sujet,$mail,$message_html);
}

function EmailReservationMachine($Nom,$Prenom,$Email,$Subject,$StartDate,$StartTime,$EndTime){

	//=====Définition du sujet.
	$sujet = "Réservation Machine FabLab";
	//=========

	$mail = $Email; // Déclaration de l'adresse de destination.

	//=====Déclaration des messages au format texte et au format HTML.
	$message_html = "<html><head></head><body>";
	$message_html .= "<center><img src='https://dev.onlfait.ch/Image/Logo/OnLFait.jpg' alt='Logo'></center><br/>";
	$message_html .= "<font size='6'><center><b>Réservation de machine</b></center></font><br/>";
	$message_html .= "Bonjour " . $Prenom . " " . $Nom . "," . "<br/><br/>";
	$message_html .= "la réservation suivant a été enregistrée: <br/>";
	$message_html .= $Subject . ", le " . $StartDate . " entre " . $StartTime . " et " . $EndTime . "<br/><br/>";
	$message_html .= "<br/>";
	$message_html .= "Les conditions d'annulation sont les suivantes: <br/>";
	$message_html .= "- Plus d'un jour avant la réservation: Gratuit (vos heures vous seront remboursées dans votre compte personnel) <br/>";
	$message_html .= "- Moins d'un jour avant la réservation: Vos heures réservées ne vous seront pas remboursées <br/><br/>";
	$message_html .= "<br/>";
	$message_html .= "Ceci est un email automatique, merci de ne pas y répondre<br/>";
	$message_html .= "<br/>";
	$message_html .= "L'équipe du Fablab Onl'fait<br/>";

	Email($sujet,$mail,$message_html);
}



function EmailInscriptionEvent($Nom,$Prenom,$Email,$Titre,$Lieu,$HeureDebut,$HeureFin){

	//=====Définition du sujet.
	$sujet = "Inscription Atelier";
	//=========

	$mail = $Email; // Déclaration de l'adresse de destination.

	//=====Déclaration des messages au format texte et au format HTML.
	$message_html = "<html><head></head><body>";
	$message_html .= "<center><img src='https://dev.onlfait.ch/Image/Logo/OnLFait.jpg' alt='Logo'></center><br/>";
	$message_html .= "<font size='6'><center><b>Réservation de machine</b></center></font><br/>";
	$message_html .= "Bonjour " . $Prenom . " " . $Nom . "," . "<br/><br/>";
	$message_html .= "l'inscription pour l'atelier " . $Titre . " a été enregistrée: <br/>";
	$message_html .= "L'atelier commence le " . $HeureDebut . " et se termine le " . $HeureFin . "<br/><br/>";
	$message_html .= "Le lieu de l'atelier est :" . $Lieu . "<br/>";
	$message_html .= "<br/>";
	$message_html .= "Les conditions d'annulation sont les suivantes: <br/>";
	$message_html .= "- Plus d'une semaine avant l'atelier, 80% du montant total de l'atelier vous sera remboursé <br/>";
	$message_html .= "- Moins d'une semaine avant l'atelier, aucun remboursement ne sera fait <br/><br/>";
	$message_html .= "<br/>";
	$message_html .= "Ceci est un email automatique, merci de ne pas y répondre<br/>";
	$message_html .= "<br/>";
	$message_html .= "L'équipe du Fablab Onl'fait<br/>";

	Email($sujet,$mail,$message_html);
}




function Email($sujet,$mail,$message_html){
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
	mail($mail,$sujet,$message,$header);
	//==========
}
?>
