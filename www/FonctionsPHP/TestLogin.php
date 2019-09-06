<?php
//Avant tout, on ouvre la session


function TestLogin($Login,$Pw){

  //Connection à la BDD
  include("BDDConnect.php");

  //Requête pour récupérer le login dans la tobleLogin
  $result = mysqli_query($connect,"SELECT ID FROM $TableLogin WHERE Login='$Login'");
  $Array = mysqli_fetch_array($result);
  $IDLogin=$Array["ID"];

  if (ISSET($IDLogin)){
    //Recherche du password correspondant à cet ID
    $result = mysqli_query($connect,"SELECT Pw FROM $TableLogin WHERE ID='$IDLogin'");
    $Array = mysqli_fetch_array($result);
    $PwFromTable=$Array["Pw"];

    if ($PwFromTable==$Pw){
      //Ouvre une variable disant que le contrôle du pw a été fait
      //Ceci évite l'ouverture d'une session simplement en introduisant un nombre
      //aléatoire à la variable $IDLogin
      $PwVerif = 1;

      $_SESSION['Login']=$Login;
      $_SESSION['Password']=$Pw;
      $_SESSION['IDLogin']=$IDLogin;
      $_SESSION['PwVerif']=$PwVerif;
    }else{
      //Efface les variables récoltées si le pw de la table ne corresond pas au pw introduit
      unset($IDLogin,$IDPw,$PwFromTable,$PwVerif,$Login,$Pw);
      session_destroy();
      return $message="Ce mot de passe n'est pas correct";
    }
  }else{
    //Efface les variables récoltées si le Login n'est pas connu
    unset($IDLogin,$IDPw,$PwFromTable,$PwVerif,$Login,$Pw);
    session_destroy();
    return $message="Ce Login n'est pas connu";
  }
  //Fermeture de BDD
  mysqli_close($connect);
}
?>
