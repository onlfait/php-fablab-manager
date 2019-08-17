<?php session_start();

function UploadImage($dossier,$NomImage,$extensions){

  //$fichier = basename($_FILES['SendImage']['name']);
  $fichier = $NomImage;
  $taille_maxi = 1000000;
  $taille = filesize($_FILES['SendImage']['tmp_name']);
  $extension = strrchr($_FILES['SendImage']['name'], '.');

  //Début des vérifications de sécurité...
  if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
  {
       $message = 'Extention du fichier incorrect';
  }
  if($taille>$taille_maxi)
  {
      $tailleMo=$taille/1000000;
       $message = 'Le fichier image est trop gros... ('.$tailleMo.' Mo)';
  }
  if ($_FILES['SendImage']['error'] == 4) {
      $message = 'Pas de fichier image envoyé';
  }
  if(!isset($message)) //S'il n'y a pas d'erreur, on upload
  {
       //On formate le nom du fichier ici...
       $fichier = strtr($fichier,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
       $fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $fichier);
       if(move_uploaded_file($_FILES['SendImage']['tmp_name'], $dossier . $fichier . $extension)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
       {
            $message = 'Upload de l\'image effectué avec succès !';
       }
       else //Sinon (la fonction renvoie FALSE).
       {
            $message = 'Echec de l\'upload de l\'image !';
       }
  }
  return $message;
}




function UploadZip($dossier,$NomZip){

  //$fichier = basename($_FILES['SendZip']['name']);
  $fichier = $NomZip;
  $taille_maxi = 1000000;
  $taille = filesize($_FILES['SendZip']['tmp_name']);
  $extensions = array('.zip');
  $extension = strrchr($_FILES['SendZip']['name'], '.');
  //Début des vérifications de sécurité...
  if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
  {
       $message = 'Vous devez uploader un fichier de type zip';
  }
  if($taille>$taille_maxi)
  {
     $tailleMo=$taille/1000000;
     $message = 'Le fichier zip est trop gros... ('.$tailleMo.' Mo)';
  }
  if ($_FILES['SendZip']['error'] == 4) {
       $message = 'Pas de fichier image envoyé';
  }
  if(!isset($message)) //S'il n'y a pas d'erreur, on upload
  {
       //On formate le nom du fichier ici...
       $fichier = strtr($fichier,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
       $fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $fichier);
       if(move_uploaded_file($_FILES['SendZip']['tmp_name'], $dossier . $fichier . $extension)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
       {
            $message = 'Upload du fichier zip effectué avec succès !';
       }
       else //Sinon (la fonction renvoie FALSE).
       {
            $message = 'Echec de l\'upload du fichier zip !';
       }
  }
  return $message;
}
?>
