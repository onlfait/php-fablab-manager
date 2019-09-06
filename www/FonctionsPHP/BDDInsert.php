<?php 

include("SecurePOST2BDD.php");

$InsertWhat = securite_bdd($_POST['InsertWhat']);



////////////////////////////////////////////////////////////////////////////
//Enregistrement d'une réservation de machine
////////////////////////////////////////////////////////////////////////////
if($InsertWhat=='Reservation'){
  $Date = securite_bdd($_POST['DateReservation']);
  $HeureStart = $_POST['HeureStart'];
  $MinuteStart = $_POST['MinuteStart'];
  $HeureEnd = $_POST['HeureEnd'];
  $MinuteEnd = $_POST['MinuteEnd'];
  $Machine = securite_bdd($_POST['Machine']);
  $IDMembre = $_SESSION['IDLogin'];

  if($Machine==1){
    $MachineName="Imprimante 3D n1";
  }elseif ($Machine==2) {
    $MachineName="Imprimante 3D n2";
  }elseif ($Machine==3) {
    $MachineName="Decoupeuse Laser";
  }elseif ($Machine==4) {
    $MachineName="CNC";
  }elseif ($Machine==5) {
    $MachineName="Thermoformeuse";
  }elseif ($Machine==20) {
    $MachineName="FabLab";
  }


  if($Machine==1){
    $Color="#ff9999"; //rouge
  }elseif($Machine==2){
    $Color="#33cc33"; //vert
  }elseif($Machine==3){
    $Color="#3399ff"; //bleu
  }elseif($Machine==4){
    $Color="#ffff99"; //jaune
  }elseif($Machine==5){
    $Color="#ff99ff"; //rose
  }elseif($Machine==20){
    $Color="#000000"; //noir
  }


  $Subject = $MachineName . " (" . $_SESSION['Prenom'] . " " . $_SESSION['Nom'] . ")";
  $StartDate = $Date;
  $EndDate = $Date;
  $JourSemaine = array(1=>"lundi", 2=>"mardi", 3=>"mercredi", 4=>"jeudi", 5=>"vendredi", 6=>"samedi", 7=>"dimanche");
  $Jour=$JourSemaine[date('N', strtotime($Date))];
  $StartTime = $HeureStart . ":" . $MinuteStart . ":" . "00";
  $EndTime = $HeureEnd . ":" . $MinuteEnd . ":" . "00";
  $StartTimeFull = $Date . " " . $HeureStart . ":" . $MinuteStart . ":" . "00";
  $EndTimeFull = $Date . " " . $HeureEnd . ":" . $MinuteEnd . ":" . "00";
  $StartTimeTS=date_timestamp_get(date_create($StartTimeFull));
  $EndTimeTS=date_timestamp_get(date_create($EndTimeFull));

  //Condition de réservation:
  //Pas un jour de fermeture
  $MessageError="";
  include("config.php");
  if(in_array($Jour, $JourFermeture)){
    $MessageError=$MessageError . "A cette date, le FablLab est fermé <br>";
    $ReservationPossible=0;
  }

  //Dans la période de payement de la cotisation
  if($StartTimeTS>date_timestamp_get(date_create($_SESSION['EcheanceCoti']))){
    $MessageError=$MessageError . "La réservation n'est pas possible car votre cotisation n'est pas payée pour cette période. Il vous est possible de payer votre cotisation dans votre éspace membre <br>";
  }

  //Heure achetée suffisante
  list($heure, $minute, $seconde) = preg_split('[:]', $_SESSION['NbreHeure']);
  if((($heure*3600)+($minute*60)+($seconde))<($EndTimeTS-$StartTimeTS)){
    $MessageError=$MessageError . "La réservation n'est pas possible car vous n'avez pas assez d'heure à disposition. Il est possible d'en acheter dans votre éspcae membre <br>";
  }

  //Disponibilité de la plage horaire
  //Connection à la BDD
  include("BDDConnect.php");
  //Requête pour récupérer les réservations dans la plage horaire de la réservation
  $result = mysqli_query($connect,"SELECT COUNT(*) as Occupation FROM $TableCalendrier WHERE ((title='$Subject' or title='Fablab') and start_timestamp<$EndTimeTS and end_timestamp>$StartTimeTS)");
  $Array = mysqli_fetch_array($result);
  $Occupation=$Array["Occupation"];
  if($Occupation!=0){
    $MessageError=$MessageError . "La plage horaire est déjà occupée <br>";
  }

  //Durée de la réservation
  if($StartTimeTS>=$EndTimeTS){
    $MessageError=$MessageError . "Le temps de réservation est trop court <br>";
  }

  if($MessageError==""){
    //Requête pour insérer la réservation dans la BDD
    $result = mysqli_query($connect,"INSERT INTO $TableCalendrier (cal_id,IDMembre,start_date,start_time,start_timestamp,end_date,end_time,end_timestamp,title,backgroundColor,borderColor,available)
    VALUES ('1','$IDMembre','$StartDate','$StartTime','$StartTimeTS','$EndDate','$EndTime','$EndTimeTS','$Subject','$Color','$Color','1')");

    if(substr($Subject,6)!="FabLab"){
      list($year,$month,$day,$hour,$minute,$seconde) = preg_split("/[\s:-]+/",date("Y-m-d h:i:s",(($heure*3600)+($minute*60)+($seconde))-($EndTimeTS-$StartTimeTS)));
      $day=$day-1;
      $hour=$hour-1;
      $_SESSION['NbreHeure']=$hour+(24*$day) . ":" . $minute . ":" . $seconde;
      //Requête pour updater les heures disponibles du membre qui a fait la réservaation
      $result = mysqli_query($connect,"UPDATE $TableMembres SET NbreHeure='$_SESSION[NbreHeure]' WHERE ID='$_SESSION[IDLogin]'");
    }

    include("EmailSendFunctions.php");
    EmailReservationMachine($_SESSION['Nom'],$_SESSION['Prenom'],$_SESSION['Email'],$Subject,$StartDate,$StartTime,$EndTime);
    $message="La réservation est enregistrée, un email vous a été envoyé";


  }else{
    $message=$MessageError;
  }
  //Fermeture de BDD
  mysqli_close($connect);




////////////////////////////////////////////////////////////////////////////
//Enregistrement d'un projet
////////////////////////////////////////////////////////////////////////////
}elseif($InsertWhat=='Projet'){
  $NoMembre=$_SESSION['IDLogin'];
  $Titre = securite_bdd($_POST['Titre']);
  $Description = securite_bdd($_POST['Description']);
  $DateSave = date("Y.m.d");

  //Connection à la BDD
  include("BDDConnect.php");
  //Requête pour récupérer l'ID du dernier projet. Incrémenté de 1, il correspondra au nom de l'image et du zip
  $result = mysqli_query($connect,"SELECT MAX(ID) as MaxID FROM $TableProjetPerso");
  $Array = mysqli_fetch_array($result);
  $ID=$Array["MaxID"]+1;

  include("Upload.php");
  $NomImage=$ID;
  $dossier = '../Upload/ProjetImage/';
  $extensions = array('.png', '.gif', '.jpg', '.jpeg');
  $MessageImage = UploadImage($dossier,$NomImage,$extensions);
  $dossier = '../Upload/ProjetZip/';
  $NomZip=$ID;
  $extensions = array('.zip');
  $MessageZip = UploadZip($dossier,$NomZip,$extensions);

  if(substr($MessageImage,0,6)=='Upload'){
    if(substr($MessageZip,0,6)=='Upload' OR substr($MessageZip,0,3)=='Pas'){
      if(substr($MessageZip,0,3)=='Pas'){
        $ZipFile=0;
      }else{
        $ZipFile=1;
      }
      //Requête pour insérer le nouveau projet dans la BDD
      $result = mysqli_query($connect,"INSERT INTO $TableProjetPerso (ID,NoMembre,Titre,Description,DateSave,ZipFile)
      VALUES ('$ID','$NoMembre','$Titre','$Description','$DateSave','$ZipFile')");

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

      $message="Le projet est enregistré";
    }else{
      $message=$MessageZip;
    }
  }else{
    $message=$MessageImage;
  }
  //Fermeture de BDD
  mysqli_close($connect);



  ////////////////////////////////////////////////////////////////////////////
  //Enregistrement d'un événement
  ////////////////////////////////////////////////////////////////////////////
}elseif($InsertWhat=='Event'){
  $Titre = securite_bdd($_POST['Titre']);
  $Lieu = securite_bdd($_POST['Lieu']);

  $Date = securite_bdd($_POST['DateReservation']);
  $HeureStart = $_POST['HeureStart'];
  $MinuteStart = $_POST['MinuteStart'];
  $HeureEnd = $_POST['HeureEnd'];
  $MinuteEnd = $_POST['MinuteEnd'];

  $StartTime = $Date . " " . $HeureStart . ":" . $MinuteStart . ":" . "00";
  $EndTime = $Date . " " . $HeureEnd . ":" . $MinuteEnd . ":" . "00";
  $StartTimeTS=date_timestamp_get(date_create($StartTime));
  $EndTimeTS=date_timestamp_get(date_create($EndTime));


  $Type = securite_bdd($_POST['Type']);
  $PlaceDispo = securite_bdd($_POST['PlaceMax']);
  $PlaceMax = securite_bdd($_POST['PlaceMax']);
  $Age = securite_bdd($_POST['Age']);
  $PrixMembre = securite_bdd($_POST['PrixMembre']);
  $PrixNonMembre = securite_bdd($_POST['PrixNonMembre']);

  $Description = securite_bdd($_POST['Description']);

  //Connection à la BDD
  include("BDDConnect.php");

  if($StartTimeTS<$EndTimeTS){
    //Requête pour récupérer l'ID du dernier événement. Incrémenté de 1, il correspondra au nom de l'image
    $result = mysqli_query($connect,"SELECT MAX(NoEvent) as MaxNoEvent FROM $TableEvent");
    $Array = mysqli_fetch_array($result);
    $IDEvent=$Array["MaxNoEvent"]+1;

    include("Upload.php");
    $dossier = '../Upload/EventImage/';
    $NomImage=$IDEvent;
    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    $MessageImage = UploadImage($dossier,$NomImage,$extensions);

    if(substr($MessageImage,0,6)=='Upload'){
      //Requête pour insérer l'événement dans la BDD
      $result = mysqli_query($connect,"INSERT INTO $TableEvent (Titre,Description,Lieu,HeureDebut,HeureFin,Age,PrixMembre,PrixNonMembre,PlaceDispo,PlaceMax)
      VALUES ('$Titre','$Description','$Lieu','$StartTime','$EndTime','$Age','$PrixMembre','$PrixNonMembre','$PlaceDispo','$PlaceMax')");

      foreach($_POST as $key => $value){
        if(substr($value,0,8)=='ATELIER_'){
          $Value2Insert=substr($value,8);
          //Requête pour insérer le type d'atelier utilisé pour cet événement
          $result = mysqli_query($connect,"INSERT INTO $TableLiaison (IDEvent,Ateliers) VALUES ('$IDEvent','$Value2Insert')");
        }

        if(substr($value,0,6)=='OUTIL_'){
          $Value2Insert=substr($value,6);
          //Requête pour insérer le type d'outils utilisés pour cet événement
          $result = mysqli_query($connect,"INSERT INTO $TableLiaison (IDEvent,Outils) VALUES ('$IDEvent','$Value2Insert')");
        }

        if(substr($value,0,6)=='SUJET_'){
          $Value2Insert=substr($value,6);
          //Requête pour insérer le type de sujets utilisés pour cet événement
          $result = mysqli_query($connect,"INSERT INTO $TableLiaison (IDEvent,Sujets) VALUES ('$IDEvent','$Value2Insert')");
        }
      }



      $message="L'évenement est enregistré";
    }else{
      $message=$MessageImage;
    }
  }else{
    $message="Le temps de réservation est trop court";
  }
  //Fermeture de BDD
  mysqli_close($connect);










////////////////////////////////////////////////////////////////////////////
//Enregistrement d'un nouveau membre
////////////////////////////////////////////////////////////////////////////
}elseif($InsertWhat=='NewMember'){
  $Login = securite_bdd($_POST['Login']);
  $Pw = securite_bdd($_POST['Pw']);
  $Nom = securite_bdd($_POST['Nom']);
  $Prenom = securite_bdd($_POST['Prenom']);
  $Email = securite_bdd($_POST['Email']);

  if (empty($Login) OR empty($Pw) OR empty($Nom) OR empty($Prenom) OR empty($Email)){
    $message="Tous les champs ne sont pas complétés. Merci de revenir en arrière pour compléter le formulaire";
  }else{
    if(strpos($Email,'@')!==false){

      //Connection à la BDD
      include("BDDConnect.php");

      //Requête pour récupérer un Login identique à celui utilisé pour l'enregistrement d'un nouveau membre
      $result = mysqli_query($connect,"SELECT * FROM $TableLogin WHERE Login='$Login'");
      $NbreLogin = mysqli_num_rows($result);

      //Fermeture de BDD
      mysqli_close($connect);

      if($NbreLogin==0){

        //Connection à la BDD
        include("BDDConnect.php");

        $DateInscription = date("y.m.d");
        $EcheanceCoti = date("y.m.d");

        //Requête pour insérer le nouveau membre dans la BDD
        $result = mysqli_query($connect,"INSERT INTO $TableMembres(Nom,Prenom,Email,DateInscription,EcheanceCoti)
        VALUES ('$Nom','$Prenom','$Email','$DateInscription','$EcheanceCoti')");

        //Requête pour récupérer l'ID du nouveau membre
        $result = mysqli_query($connect,"SELECT MAX(ID) as MaxNoMembre FROM $TableMembres");
        $Array = mysqli_fetch_array($result);
        $IDMembre=$Array["MaxNoMembre"];

        $checked=0;
        foreach($_POST as $key => $value){
          if($value=='Newsletter'){
            echo "test OK";
            //Requête pour insérer l'inscription à la Newsletter
            $checked=1;
          }
        }
        mysqli_query($connect,"UPDATE $TableMembres SET Newsletter='$checked' WHERE ID='$IDMembre'");

        foreach($_POST as $key => $value){
          if(substr($value,0,6)=='OUTIL_'){
            $Value2Insert=substr($value,6);
            //Requête pour insérer les outils utilisés par le nouveau membre
            $result = mysqli_query($connect,"INSERT INTO $TableLiaison (IDMembre,Outils) VALUES ('$IDMembre','$Value2Insert')");
          }

          if(substr($value,0,6)=='SUJET_'){
            //Requête pour insérer les sujets utilisés par le nouveau membre
            $Value2Insert=substr($value,6);
            $result = mysqli_query($connect,"INSERT INTO $TableLiaison (IDMembre,Sujets) VALUES ('$IDMembre','$Value2Insert')");
          }
        }
        //Fermeture de BDD
        mysqli_close($connect);

        //Connection à la BDD
        include("BDDConnect.php");

        //Requête pour insérer le login du nouveau membre dans la BDD
        $result = mysqli_query($connect,"INSERT INTO $TableLogin(Login,Pw) VALUES ('$Login','$Pw')");
        include("EmailSendFunctions.php");
        EmailNouveauMembre($IDMembre,$Nom,$Prenom,$Email,$Login);
        $message="Enregistré en temps que nouveau membre du site du FabLab On l'Fait";

        //Fermeture de BDD
        mysqli_close($connect);
      }else{
        $message="Ce login est déjà utilisé";
      }
    }else{
      $message="L'email n'est pas valide";
    }
  }









////////////////////////////////////////////////////////////////////////////
//Enregistrement d'un nouvel outil
////////////////////////////////////////////////////////////////////////////
}elseif($InsertWhat=='AddOutil'){
$AddOutilName = securite_bdd($_POST['AddOutilName']);
$AddOutilVariableName = securite_bdd($_POST['AddOutilVariableName']);

  if (empty($AddOutilName) OR empty($AddOutilVariableName)){
    $message="Le champs n'est pas complété";
  }else{
    //Connection à la BDD
    include("BDDConnect.php");

    include("Upload.php");
    $dossier = '../Image/Picto/';
    $NomImage="Outil_".$AddOutilVariableName;
    $extensions = array('.png');
    $MessageImage = UploadImage($dossier,$NomImage,$extensions);

    if(substr($MessageImage,0,6)=='Upload'){
      //Requête pour insérer un nouvel outil dans la BDD
      $result = mysqli_query($connect,"INSERT INTO $TableOutils(OutilName,OutilVariableName) VALUES ('$AddOutilName','$AddOutilVariableName')");

      $message="Enregistrement du nouvel outil effectué";
    }else{
      $message=$MessageImage;
    }
    //Fermeture de BDD
    mysqli_close($connect);

  }


////////////////////////////////////////////////////////////////////////////
//Enregistrement d'un nouveau sujet
////////////////////////////////////////////////////////////////////////////
}elseif($InsertWhat=='AddSujet'){
  $AddSujetName = securite_bdd($_POST['AddSujetName']);
  $AddSujetVariableName = securite_bdd($_POST['AddSujetVariableName']);

  if (empty($AddSujetName) OR empty($AddSujetVariableName)){
    $message="Le champs n'est pas complété";
  }else{
    //Connection à la BDD
    include("BDDConnect.php");

    //Requête pour insérer un nouveau sujet dans la BDD
    $result = mysqli_query($connect,"INSERT INTO $TableSujets(SujetName,SujetVariableName) VALUES ('$AddSujetName','$AddSujetVariableName')");

    include("Upload.php");
    $dossier = '../Image/Picto/';
    $NomImage="Sujet_".$AddSujetVariableName;
    $extensions = array('.png');
    $MessageImage = UploadImage($dossier,$NomImage,$extensions);

    //Fermeture de BDD
    mysqli_close($connect);

    $message="Enregistrement du nouveau sujet effectué";
  }



////////////////////////////////////////////////////////////////////////////
//Enregistrement d'un nouveau type d'atelier
////////////////////////////////////////////////////////////////////////////
}elseif($InsertWhat=='AddAtelier'){
  $AddAtelierName = securite_bdd($_POST['AddAtelierName']);
  $AddAtelierVariableName = securite_bdd($_POST['AddAtelierVariableName']);

  if (empty($AddAtelierName) OR empty($AddAtelierVariableName)){
    $message="Le champs n'est pas complété";
  }else{
    //Connection à la BDD
    include("BDDConnect.php");

    //Requête pour insérer un nouveau type d'atelier dans la BDD
    $result = mysqli_query($connect,"INSERT INTO $TableAteliers(AtelierName,AtelierVariableName) VALUES ('$AddAtelierName','$AddAtelierVariableName')");

    include("Upload.php");
    $dossier = '../Image/Picto/';
    $NomImage="Atelier_".$AddAtelierVariableName;
    $extensions = array('.png');
    $MessageImage = UploadImage($dossier,$NomImage,$extensions);

    //Fermeture de BDD
    mysqli_close($connect);

    $message="Enregistrement du nouvel atelier effectué";
  }
}

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
    <?php
    if($InsertWhat=='Reservation'){
      Reservation($message);
    }elseif($InsertWhat=='Projet'){
      SaveProjet($message);
    }elseif($InsertWhat=='Event'){
      SaveEvent($message);
    }elseif($InsertWhat=='NewMember'){
      SaveNewMember($message);
    }elseif($InsertWhat=='AddSujet' OR $InsertWhat=='AddOutil' OR $InsertWhat=='AddAtelier'){
      AddSujetOutil($message);
    }?>

  </div><!-- #centercolumn -->
</div><!-- #content -->

<?php include("pied_de_page.php"); ?>

</body>
</html>


<?php
function Reservation($message){ ?>
  <p class="SousSousTitreC">Confirmation de la réservation</p>
  <p class="TexteC"><?php echo $message ?></p>

  <form action="../EspaceMembres.php">
    <td class="TexteCentre"><input type="submit" value="Retour Espace Membres" size=20></td>
  </form>
  <?php
}


function SaveProjet($message){ ?>
  <p class="SousSousTitreC">Confirmation de l'enregistrement du projet</p>
  <p class="TexteC"><?php echo $message ?></p>
  <form action="../EspaceMembres.php">
    <td class="TexteCentre"><input type="submit" value="Retour Espace Membres" size=20></td>
  </form>
  <?php
}



function SaveEvent($message){ ?>
  <p class="SousSousTitreC">Confirmation de l'enregistrement de l'événement</p>
  <p class="TexteC"><?php echo $message ?></p>
  <form action="../EspaceMembres.php">
    <td class="TexteCentre"><input type="submit" value="Retour Espace Membres" size=20></td>
  </form>
  <?php
}



function SaveNewMember($message){ ?>
  <p class="SousSousTitreC">Confirmation de l'enregistrement comme nouveau membre</p>
  <p class="TexteC"><?php echo $message ?></p>
  <form action="../EspaceMembres.php">
    <td class="TexteCentre"><input type="submit" value="Retour Espace Membres" size=20></td>
  </form>
  <?php
}



function AddSujetOutil($message){ ?>
  <p class="SousSousTitreC">Confirmation de l'enregistrement d'un nouveau sujet, outil ou atelier</p>
  <p class="TexteC"><?php echo $message ?></p>
  <form action="../EspaceMembres.php">
    <td class="TexteCentre"><input type="submit" value="Retour Espace Membres" size=20></td>
  </form>
  <?php
} ?>
