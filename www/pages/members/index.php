<?php
include("FonctionsPHP/head_global.php");
include("FonctionsPHP/head_datepicker.php");
include("FonctionsPHP/SecurePOST2BDD.php");
?>

<div id="content">
  <div id="centercolumn">

    <?php
    //Vérification de l'authentification
    if(ISSET($_SESSION['IDLogin']) AND ISSET($_SESSION['PwVerif'])){
      MembrePersoOK();
    }else{
      $Login = securite_bdd($_POST['Login']);
      $Pw = securite_bdd($_POST['Pw']);

      if($Login!="" AND $Pw!=""){
        include("FonctionsPHP/TestLogin.php");
        $Login = securite_bdd($_POST['Login']);
        $Pw = securite_bdd($_POST['Pw']);
        $message=TestLogin($Login,$Pw);
        if(ISSET($_SESSION['IDLogin']) AND ISSET($_SESSION['PwVerif'])){
          MembrePersoOK();
        }else{
          MembrePersoKO($message);
        }
      }else{
        $message="Compléter tous les champs pour vous connecter";
        MembrePersoKO($message);
      }
    }
    ?>

  </div><!-- #centercolumn -->
</div><!-- #content -->










<?php
function MembrePersoOK(){ ?>
  <?php
  ////////////////////////////////////////////////////////////////////////////
  //Afficher les données personnelle
  ////////////////////////////////////////////////////////////////////////////

  //Requête pour récupérer les informations de l'utilisateur
  $result = mysqli_query($PFM['db']['link'],"SELECT Nom, Prenom, Email, Newsletter, DateInscription, EcheanceCoti, NbreHeure, AdminMembre FROM $TableMembres WHERE ID='$_SESSION[IDLogin]'");
  $Array = mysqli_fetch_array($result);

  $_SESSION['Nom'] = $Array["Nom"];
  $_SESSION['Prenom'] = $Array["Prenom"];
  $_SESSION['Email'] = $Array["Email"];
  $_SESSION['Newsletter'] = $Array["Newsletter"];
  $_SESSION['DateInscription'] = $Array["DateInscription"];
  $_SESSION['EcheanceCoti'] = $Array["EcheanceCoti"];
  $_SESSION['NbreHeure'] = $Array["NbreHeure"];
  $_SESSION['AdminMembre'] = $Array["AdminMembre"];

  ?>
  <!--//Formulaire pour fermer la session-->
  <form class="TexteC" action="FonctionsPHP/SessionEnd.php" method="post">
    <td><input style="width:200px" type="submit" value="Fermer votre session"></td>
  </form>
  <p class="SousTitreC"> Espace Membre Perso </p>
  <p class="SousSousTitreC"> Vos données personnelles : </p>
  <table border="0" width="100%">
    <form method="POST" action="FonctionsPHP/BDDUpdate.php" enctype="multipart/form-data">
    <input name="Variable2Change" type="hidden" size=20 value="DonneeMembre">
    <tr>
      <td class="TexteC" width=25%>N° Membre :</td>
      <td class="TexteC" width=75%><?php echo $_SESSION['IDLogin'] ?></td>
    </tr>
    <tr>
      <td class="TexteC">Login :</td>
      <td class="TexteC"><?php echo $_SESSION['Login'] ?></td>
    </tr>
    <tr>
      <td class="TexteC">Password :</td>
      <td class="TexteC"><input name="Password" type="password" size=20 value="<?php echo $_SESSION["Password"] ?>"></td>
    </tr>
    <tr>
      <td class="TexteC">Nom :</td>
      <td class="TexteC"><input name="Nom" type="VarChar" size=20 value="<?php echo $_SESSION["Nom"] ?>"></td>
    </tr>
    <tr>
      <td class="TexteC">Prénom :</td>
      <td class="TexteC"><input name="Prenom" type="VarChar" size=20 value="<?php echo $_SESSION["Prenom"] ?>"></td>
    </tr>
    <tr>
      <td class="TexteC">Email :</td>
      <td class="TexteC"><input name="Email" type="VarChar" size=50 value="<?php echo $_SESSION["Email"] ?>"></td>
    </tr>
    <tr>
      <td class="TexteC">Inscription Newsletter mensuelle :</td>
      <?php
      if($_SESSION["Newsletter"]==1 ){?>
        <td class="TexteC"><input type="checkbox" name="Newsletter" value="Newsletter" checked></td>
      <?php }else{ ?>
        <td class="TexteC"><input type="checkbox" name="Newsletter" value="Newsletter"></td>
      <?php } ?>
    </tr>
    <tr>
      <td class="TexteC">Date d'inscription :</td>
      <td class="TexteC"><?php echo $_SESSION['DateInscription'] ?></td>
    </tr>
    <tr>
      <td class="TexteC">Echéance de la cotisation :</td>
      <td class="TexteC"><?php echo $_SESSION['EcheanceCoti'] ?></td>
    </tr>
    <tr>
      <td class="TexteC">Nbre d'heure à disposition :</td>
      <td class="TexteC"><?php echo $_SESSION['NbreHeure'] ?></td>
    </tr>

    <tr>
      <td colspan=4 align="left" valign="center" class="TexteC" width="15%">Outils :</td>
    </tr>
    <tr>
      <td class="TexteC" valign="top">
        <?php
        //Requête pour récupérer le choix de outils
        $resultOutils = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableOutils ORDER BY ID");
        while ($rowAll = mysqli_fetch_array($resultOutils)){
          $rowAllTemp=$rowAll["OutilVariableName"];

          $checked=0;
          $resultLiaison = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableLiaison WHERE IDMembre='$_SESSION[IDLogin]' AND Outils IS NOT NULL");
          while ($row = mysqli_fetch_array($resultLiaison)){
            $rowTemp=$row["Outils"];
            if($rowAllTemp==$rowTemp){
              $checked=1;
            }
          }
          if($checked==1){?>
            <input type="checkbox" name=<?php echo $rowAll["OutilVariableName"]?> value=<?php echo "OUTIL_".$rowAll["OutilVariableName"]?> checked><?php echo $rowAll["OutilName"]?><br>
            <?php
          }else{?>
            <input type="checkbox" name=<?php echo $rowAll["OutilVariableName"]?> value=<?php echo "OUTIL_".$rowAll["OutilVariableName"]?>><?php echo $rowAll["OutilName"]?><br>
            <?php
          }
        }
        ?>
      </td>
      <td colspan=3 align="left" valign="center" class="TexteC" width="85%">
        <?php
        //Requête pour récupérer les outils liés à chaque projet
        $resultLiaison = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableLiaison WHERE IDMembre='$_SESSION[IDLogin]' AND Outils IS NOT NULL");
        while ($row = mysqli_fetch_array($resultLiaison)){
          $ImagePath="Image/Picto/Outil_" . $row["Outils"] . ".png" ?>
          <img src=<?php echo $ImagePath; ?> height="75">
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td colspan=4 align="left" valign="center" class="TexteC">Sujet :</td>
    </tr>
    <tr>
      <td class="TexteC" valign="top">
        <?php
        //Requête pour récupérer le choix de sujets
        $resultSujets = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableSujets ORDER BY ID");
        while ($rowAll = mysqli_fetch_array($resultSujets)){
          $rowAllTemp=$rowAll["SujetVariableName"];

          $checked=0;
          $resultLiaison = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableLiaison WHERE IDMembre='$_SESSION[IDLogin]' AND Sujets IS NOT NULL");
          while ($row = mysqli_fetch_array($resultLiaison)){
            $rowTemp=$row["Sujets"];
            if($rowAllTemp==$rowTemp){
              $checked=1;
            }
          }
          if($checked==1){?>
            <input type="checkbox" name=<?php echo $rowAll["SujetVariableName"]?> value=<?php echo "SUJET_".$rowAll["SujetVariableName"]?> checked><?php echo $rowAll["SujetName"]?><br>
            <?php
          }else{?>
            <input type="checkbox" name=<?php echo $rowAll["SujetVariableName"]?> value=<?php echo "SUJET_".$rowAll["SujetVariableName"]?>><?php echo $rowAll["SujetName"]?><br>
            <?php
          }
        }
        ?>
      </td>
      <td  colspan=3 align="left" valign="center" class="TexteC">
        <?php
        //Requête pour récupérer les sujets liés à chaque projet
        $resultLiaison = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableLiaison WHERE IDMembre='$_SESSION[IDLogin]' AND Sujets IS NOT NULL");
        while ($row = mysqli_fetch_array($resultLiaison)){
          $ImagePath="Image/Picto/Sujet_" . $row["Sujets"] . ".png"?>
          <img src=<?php echo $ImagePath; ?> height="75">
          <?php
        }?>
      </td>
    </tr>
    <td colspan="4" class="TexteC"><input style="width:170px" type="submit" name="miseajour" value="Mettre à jour"></td>
  </form>
  </table>
  <br>


  <table border="1" width=100%>
    <tr>
    </tr>
  </table>
  <br>

  <?php
  ////////////////////////////////////////////////////////////////////////////
  //Calendrier d'administrateur
  ////////////////////////////////////////////////////////////////////////////
  ?>
  <p class="SousSousTitreC"><br></p>
  <p class="SousSousTitreC"> Calendrier de disponibilité des administrateurs </p>
  <iframe src="https://dev.onlfait.ch/EventCalendar/guest.php" style="border: 0" width="100%" height="900"></iframe>

  <!--//Formulaire pour la réservation de machine-->
  <form action="FonctionsPHP/BDDInsert.php" method="post">
    <table border="0" class="TexteC">
      <tr>
        <td class="TexteC" width=50%>Personne faisant la requête :</td>

        <td class="TexteC" width=50%>
          <?php
          //Requête pour lire les réservation du membre
          $result = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableMembres WHERE AdminMembre='1' ORDER BY Prenom DESC");?>
          <select name="PersonneRequete">
          <?php
          while ($row = mysqli_fetch_array($result)){ ?>
              <option value=<?php echo $row["Prenom"]."_".$row["Nom"];?>><?php echo $row["Prenom"] . " " . $row["Nom"];?></option>
          <?php } ?>
          </select>
        </td>

      </tr>
      <tr>
        <td class="TexteC" width=50%>Personne concernée par la réservation :</td>
        <td class="TexteC" width=50%>
          <?php
          //Requête pour lire les réservation du membre
          $result = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableMembres WHERE AdminMembre='1' ORDER BY Prenom DESC");?>
          <select name="PersonneReservation">
          <?php
          while ($row = mysqli_fetch_array($result)){ ?>
              <option value=<?php echo $row["Prenom"]."_".$row["Nom"];?>><?php echo $row["Prenom"] . " " . $row["Nom"];?></option>
          <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td class="TexteC" width=50%>Machine :</td>
        <td class="TexteC" width=50%>
          <select size="1" name="Machine">
            <option value="1">Imprimante 3D n1</option>
            <option value="2">Imprimante 3D n2</option>
            <option value="3">Découpeuse Laser</option>
            <option value="4">CNC</option>
            <option value="5">Thermoformeuse</option>
            <option value="20">FabLab</option>
          </select>
        </td>
      </tr>
      <tr>
        <!--Les propriétés du date picker se trouve dans le head-->
        <td class="TexteC">Date de la réservation:</td>
        <!--<td><input name="DateReservation" type="TexteC" id="datepicker" size="15" ></td> -->
        <td><input type="TextC" name="DateReservation" class="datepicker"/></td>
      </tr>
      <tr>
        <td class="TexteC">Heure Début :</td>
        <td class="TexteC">
          <select size="1" name="HeureStart">
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
          </select>
          <select size="1" name="MinuteStart">
            <option>00</option>
            <option>15</option>
            <option>30</option>
            <option>45</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="TexteC">Heure Fin :</td>
        <td class="TexteC">
          <select size="1" name="HeureEnd">
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
          </select>
          <select size="1" name="MinuteEnd">
            <option>00</option>
            <option>15</option>
            <option>30</option>
            <option>45</option>
          </select>
        </td>
      </tr>
      <tr>
        <input name="InsertWhat" type="hidden" size=20 value="<?php echo "Reservation" ?>">
        <td class="TexteC"></td>
        <td><input style="width:100px" type="submit" value="Réserver"></td>
      </tr>
    </table>
  </form>


  <table border="1" width=100%>
    <tr>
    </tr>
  </table>
  <?php
  ////////////////////////////////////////////////////////////////////////////
  //Modification des données personnelle d'un autre membre
  ////////////////////////////////////////////////////////////////////////////
  if($_SESSION['AdminMembre']==1){?>

    <p class="SousSousTitreC"><br></p>
    <p class="SousSousTitreC"> Modification de données personnelles d'un autre membre, suppression d'un membre : </p>

    <!--//Formulaire pour la modification des données perso -->
    <table border="0" width=100%>
      <form class="TexteC" action="FonctionsPHP/BDDRead.php" method="post">
        <tr>
          <td class="TexteC" width=25%>Membre à modifier :</td>
          <td class="TexteC" width=75%>
            <?php
            //Requête pour lire les différents ateliers
            $result = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableMembres ORDER BY Nom ASC");?>
            <select name="IDMembre">
              <?php
              while ($row = mysqli_fetch_array($result)){ ?>
                <option value=<?php echo $row["ID"];?>><?php echo $row["Nom"] . " " .  $row["Prenom"];?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr>
          <input type="hidden" name="Info2Get" value="DonneeMembreByAdmin">
          <td class="TexteC" colspan=2><input style="width:200px" type="submit" name="Afficher" value="Afficher données membres"></td>
        </tr>
      </form>
    </table>
    <br>

    <table border="1" width=100%>
      <tr>
      </tr>
    </table>
    <br>
  <?php
  }
  ////////////////////////////////////////////////////////////////////////////
  //Réservation de machine
  ////////////////////////////////////////////////////////////////////////////

  if($_SESSION['AdminMembre']==1){?>
    <p class="SousSousTitreC">Réservation Machine / Fermeture du Fablab</p>
    <?php
  }else{?>
    <p class="SousSousTitreC">Réservation Machine</p>
    <?php
  }?>
  <a href="espaceTravail.php"><p class="TexteC">Calendrier des disponibilités</p></a>
  <!--//Formulaire pour la réservation de machine-->
  <form action="FonctionsPHP/BDDInsert.php" method="post">
    <table border="0" class="TexteC" width=50%>
      <tr>
        <td class="TexteC" width=50%>Machine :</td>
        <td class="TexteC" width=50%>
          <?php
          if($_SESSION['AdminMembre']==1){?>
            <select size="1" name="Machine">
              <option value="1">Imprimante 3D n1</option>
              <option value="2">Imprimante 3D n2</option>
              <option value="3">Découpeuse Laser</option>
              <option value="4">CNC</option>
              <option value="5">Thermoformeuse</option>
              <option value="20">FabLab</option>
            </select>
            <?php
          }else{?>
            <select size="1" name="Machine">
              <option value="1">Imprimante 3D n1</option>
              <option value="2">Imprimante 3D n2</option>
              <option value="3">Découpeuse Laser</option>
              <option value="4">CNC</option>
              <option value="5">Thermoformeuse</option>
            </select>
            <?php
          }?>
        </td>
      </tr>
      <tr>
        <!--Les propriétés du date picker se trouve dans le head-->
        <td class="TexteC">Date de la réservation:</td>
        <!--<td><input name="DateReservation" type="TexteC" id="datepicker" size="15" ></td> -->
        <td><input type="TextC" name="DateReservation" class="datepicker"/></td>
      </tr>
      <tr>
        <td class="TexteC">Heure Début :</td>
        <td class="TexteC">
          <select size="1" name="HeureStart">
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
          </select>
          <select size="1" name="MinuteStart">
            <option>00</option>
            <option>15</option>
            <option>30</option>
            <option>45</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="TexteC">Heure Fin :</td>
        <td class="TexteC">
          <select size="1" name="HeureEnd">
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
          </select>
          <select size="1" name="MinuteEnd">
            <option>00</option>
            <option>15</option>
            <option>30</option>
            <option>45</option>
          </select>
        </td>
      </tr>
      <tr>
        <input name="InsertWhat" type="hidden" size=20 value="<?php echo "Reservation" ?>">
        <td class="TexteC"></td>
        <td><input style="width:100px" type="submit" value="Réserver"></td>
      </tr>
    </table>
  </form>


  <p class="SousSousTitreC">Suppression de réservation de machine</p>
  <table border="0" width=100%>
    <!--//Formulaire pour permettre d'effacer une réservation de machine-->
    <form method="POST" action="FonctionsPHP/BDDDelete.php" enctype="multipart/form-data">
      <tr>
        <td class="TexteC" width=25%>Vos réservation  : </td>
        <td class="TexteC" width=75%>
          <?php
          //Requête pour lire les réservation du membre
          $result = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableCalendrier WHERE IDMembre='$_SESSION[IDLogin]' ORDER BY start_timestamp DESC");?>
          <select name="NumeroReservationMachine">
          <?php
          while ($row = mysqli_fetch_array($result)){ ?>
              <option value=<?php echo $row["id"];?>><?php echo $row["start_date"] . " (" . $row["start_time"] . " - " . $row["end_time"] . ") " . $row["title"] ;?></option>
          <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <input type="hidden" name="DeleteWhat" value="ReservationMachine">
        <td class="TexteC"></td>
        <td class="TexteC" align="right"><input style="width:200px" type="submit" name="envoyer" value="Supprimer la réservation"></td>
      </tr>
      <tr>
        <td class="TexteC" colspan=2>Coût de l'annulation:</td>
      </tr>
      <tr>
        <td class="TexteC" colspan=2>- Plus d'un jour avant la réservation: Gratuit (vos heures vous seront remboursées dans votre compte personnel) <br/> - Moins d'un jour avant la réservation: Vos heures réservées ne vous seront pas remboursées</td>
      </tr>
    </form>
  </table>


  <table border="1" width=100%>
    <tr>
    </tr>
  </table>
  <br>

  <?php
  ////////////////////////////////////////////////////////////////////////////
  //Achat de pack d'heure
  ////////////////////////////////////////////////////////////////////////////
  ?>
  <p class="SousSousTitreC">Réservation de pack d'heures</p>
  <!--//Formulaire pour l'achat d'un pack d'heure'-->
  <form action="FonctionsPHP/BDDUpdate.php" method="post">
    <table border="0" class="Texte" width=100%>
      <td class="TexteC" width=25%>Package d'heure :</td>
      <td class="TexteC" width=75%>
        <select size="1" name="NewValue">
          <option value="5">"Padawan", 5h, 100CHF</option>
          <option value="10">"Jedi", 10h, 150CHF</option>
          <option value="20">"la 42", 20h, 200CHF</option>
          <option value="1">"Accompagnement", 1h, 50CHF</option>
          <option value="1">"Mandats externes", 1h, 120CHF</option>
          <option value="3">"Formation de base sur une de nos machines, 3h, 150CHF</option>
        </select>
      </td>
    </table>

    <input name="Variable2Change" type="hidden" size=20 value="NbreHeure">
    <td><input style="width:100px" type="submit" value="Acheter"></td>
  </form>



  <table border="1" width=100%>
    <tr>
    </tr>
  </table>
  <br>



  <?php
  ////////////////////////////////////////////////////////////////////////////
  //Payement de cotisation
  ////////////////////////////////////////////////////////////////////////////
  ?>
  <p class="SousSousTitreC">Payement de la cotisation annuelle ou don</p>
  <!--//Formulaire pour payer une cotisation-->
  <form action="FonctionsPHP/BDDUpdate.php" method="post">
    <table border="0" class="Texte" width=100%>
      <td class="TexteC" width=25%>Payement Cotisation :</td>
      <td class="TexteC" width=75%>
        <select size="1" name="NewValue">
          <option value="365">Cotisation individuelle (1 année / 1 formation), 150CHF</option>
          <option value="365">Cotisation groupe max. 4 pers. (1 année / 1 formation collective), 300CHF</option>
          <option value="0">Don</option>
        </select>
      </td>
    </table>
    <input name="Variable2Change" type="hidden" size=20 value="EcheanceCoti">
    <td><input style="width:100px" type="submit" value="Payement"></td>
  </form>




  <table border="1" width=100%>
    <tr>
    </tr>
  </table>
  <br>



  <?php
  ////////////////////////////////////////////////////////////////////////////
  //Enregistrement d'un projet
  ////////////////////////////////////////////////////////////////////////////
  ?>
  <p class="SousSousTitreC">Enregistrement d'un projet</p>
  <!--//Formulaire pour enregistrer un projet-->
  <form method="POST" action="FonctionsPHP/BDDInsert.php" enctype="multipart/form-data">
    <table border="0" width=100%>
      <tr>
        <td class="TexteC" width=25%>Titre: </td>
        <td width=75%><input class="TexteC" name="Titre" type="VarChar" size=30></td>
      </tr>
      <tr>
        <td class="TexteC">Description: </td>
        <td><textarea class="TexteC" name="Description" type="VarChar" rows="8" cols="45"></textarea></td>
      </tr>
      <tr>
        <td class="TexteC">Fichier Image <br> (max 1Mo, ratio L=1 / H=0.5) : </td>
        <td><input type="file" name="SendImage"></td>
      </tr>
      <tr>
        <td class="TexteC">Fichier Source <br> (max 1Mo, Fichier .zip) : </td>
        <td><input type="file" name="SendZip"></td>
      </tr>
      <tr>
        <td class="TexteC">Outils : </td><br>
        <td class="TexteC">Sujets : </td><br>
      </tr>
      <?php
      //Requête pour récupérer le choix d'outils
      $resultOutils = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableOutils ORDER BY ID");
      //Requête pour récupérer le choix de sujets
      $resultSujets = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableSujets ORDER BY ID");
      ?>
      <tr>
        <td class="TexteC" valign="top">
          <?php while ($ligne = mysqli_fetch_array($resultOutils)){ ?>
            <input type="checkbox" name=<?php echo $ligne["OutilVariableName"]?> value=<?php echo "OUTIL_".$ligne["OutilVariableName"]?>><?php echo $ligne["OutilName"]?><br>
          <?php } ?>
        </td>
        <td class="TexteC" valign="top">
          <?php while ($ligne = mysqli_fetch_array($resultSujets)){ ?>
            <input type="checkbox" name=<?php echo $ligne["SujetVariableName"]?> value=<?php echo "SUJET_".$ligne["SujetVariableName"]?>><?php echo $ligne["SujetName"]?><br>
          <?php } ?>
        </td>
      </tr>
      <tr>
        <input type="hidden" name="InsertWhat" value="Projet">
        <td class="TexteC" colspan="2"><input style="width:200px" type="submit" name="envoyer" value="Enregistrer le Projet"></td>
        <tr>
        </tr>
      </table>
    </form>


    <table border="1" width=100%>
      <tr>
      </tr>
    </table>
    <br>


    <?php
    if($_SESSION['AdminMembre']==1){
      ////////////////////////////////////////////////////////////////////////////
      //Enregistrement d'un événement
      ////////////////////////////////////////////////////////////////////////////
      ?>
      <p class="SousSousTitreC">Enregistrement d'un événement</p>
      <!--//Formulaire pour enregistrer un événement-->
      <form method="POST" action="FonctionsPHP/BDDInsert.php" enctype="multipart/form-data">
        <table border="0" width=100%>
          <tr>
            <td class="TexteC" width=25%>Titre: </td>
            <td class="TexteC" width=75%><input name="Titre" type="VarChar" size=30></td>
          </tr>
          <tr>
            <td class="TexteC">Lieu: </td>
            <td class="TexteC"><input name="Lieu" type="VarChar" size=30 value="FabLab OnlFait"></td>
          </tr>
          <tr>
            <!--Les propriétés du date picker se trouve dans le head-->
            <td class="TexteC">Date de la réservation:</td>
            <td><input type="TextC" name="DateReservation" class="datepicker"/></td>
          </tr>
          <tr>
            <td class="TexteC">Heure Début :</td>
            <td class="TexteC">
              <select size="1" name="HeureStart">
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
              </select>
              <select size="1" name="MinuteStart">
                <option>00</option>
                <option>15</option>
                <option>30</option>
                <option>45</option>
              </select>
            </td>
          </tr>
          <tr>
            <td class="TexteC">Heure Fin :</td>
            <td class="TexteC">
              <select size="1" name="HeureEnd">
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
              </select>
              <select size="1" name="MinuteEnd">
                <option>00</option>
                <option>15</option>
                <option>30</option>
                <option>45</option>
              </select>
            </td>
          </tr>
          <tr>
            <td class="TexteC">Type d'événement :</td>
            <?php
            //Requête pour récupérer le choix d'ateliers
            $result = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableAteliers ORDER BY ID");
            ?>
            <td class="TexteC">
              <select size="1" name="Atelier">
                <?php while ($ligne = mysqli_fetch_array($result)){ ?>
                  <option value=<?php echo "ATELIER_".$ligne["AtelierVariableName"]?>><?php echo $ligne["AtelierName"]?></option>
                <?php } ?>
              </select>
            </td>
          </tr>
          <tr>
            <td class="TexteC">Nombre de place max : </td>
            <td><input name="PlaceMax"></td>
          </tr>
          <tr>
            <td class="TexteC">Age: </td>
            <td><input name="Age"></td>
          </tr>
          <tr>
            <td class="TexteC">Prix Membre: </td>
            <td><input name="PrixMembre"</td>
          </tr>
          <tr>
            <td class="TexteC">Prix Non-Membre: </td>
            <td><input name="PrixNonMembre"></td>
          </tr>
          <tr>
            <td class="TexteC">Description: </td>
            <td class="TexteC">
              <textarea name="Description" type="VarChar" rows="8" cols="45"></textarea></td>
            </tr>
            <tr>
              <td  class="TexteC" width=25%>Fichier Image <br> (max 1Mo, ratio L=1 / H=0.5) : </td>
              <td  class="TexteC" width=75%><input type="file" name="SendImage"></td>
            </tr>
            <tr>
              <td class="TexteC">Outils : </td>
              <td class="TexteC">Sujets : </td>
            </tr>
            <tr>
              <?php
              //Requête pour récupérer le choix d'outils
              $resultOutils = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableOutils ORDER BY ID");
              //Requête pour récupérer le choix de sujets
              $resultSujets = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableSujets ORDER BY ID");
              ?>
              <td class="TexteC" valign="top">
                <?php while ($ligne = mysqli_fetch_array($resultOutils)){ ?>
                  <input type="checkbox" name=<?php echo $ligne["OutilVariableName"]?> value=<?php echo "OUTIL_".$ligne["OutilVariableName"]?>><?php echo $ligne["OutilName"]?><br>
                <?php } ?>
              </td>
              <td class="TexteC" valign="top">
                <?php while ($ligne = mysqli_fetch_array($resultSujets)){ ?>
                  <input type="checkbox" name=<?php echo $ligne["SujetVariableName"]?> value=<?php echo "SUJET_".$ligne["SujetVariableName"]?>><?php echo $ligne["SujetName"]?><br>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <input type="hidden" name="InsertWhat" value="Event">
              <td colspan="4"><input style="width:200px" type="submit" name="envoyer" value="Enregistrer de l'évenement"></td>
            </tr>
          </table>
        </form>

        <table border="1" width=100%>
          <tr>
          </tr>
        </table>
        <br>


        <?php
        ////////////////////////////////////////////////////////////////////////////
        //Lister les participants d'un événement
        ////////////////////////////////////////////////////////////////////////////
        ?>
        <p class="SousSousTitreC">Lister les participants d'un événement</p>
        <table border="0" width=100%>
          <!--//Formulaire pour extraire la liste des participants-->
          <form method="POST" action="FonctionsPHP/BDDRead.php" enctype="multipart/form-data">
            <tr>
              <td class="TexteC" width=25%>Nom de l'atelier: </td>
              <td class="TexteC" width=75%>
                <?php
                //Requête pour lire les différents ateliers
                $result = mysqli_query($PFM['db']['link'],"SELECT * FROM pfm_events ORDER BY NoEvent DESC");?>
                <select name="NumeroAtelier">
                <?php
                while ($row = mysqli_fetch_array($result)){ ?>
                    <option value=<?php echo $row["NoEvent"];?>><?php echo $row["Titre"];?></option>
                <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <input type="hidden" name="Info2Get" value="ParticipantAtelier">
              <td class="TexteC" colspan="2"><input style="width:100px" type="submit" name="envoyer" value="Liste"></td>
            </tr>
          </form>
        </table>





        <table border="1" width=100%>
          <tr>
          </tr>
        </table>
        <br>


        <?php
        ////////////////////////////////////////////////////////////////////////////
        //Ajout ou Effacement d'un atelier, sujet ou outils
        ////////////////////////////////////////////////////////////////////////////
        ?>
        <p class="SousSousTitreC">Ajout d'un atelier, d'un sujet ou d'un outil</p>
        <table border="0" width=100%>
          <!--//Formulaire pour ajouter un atelier-->
          <form method="POST" action="FonctionsPHP/BDDInsert.php" enctype="multipart/form-data">
            <tr>
              <td colspan="2" class="TexteC"><br></td>
            </tr>
            <tr>
              <td colspan="2" class="TexteCB">Atelier à Ajouter: </td>
            </tr>
            <tr>
              <td class="TexteC" width=25%>Nom à afficher: </td>
              <td class="TexteC" width=75%><input name="AddAtelierName"></td>
            </tr>
            <tr>
              <td class="TexteC">Nom de la variable <br>(sans caractère spéciaux, éspace, ...): </td>
              <td class="TexteC"><input name="AddAtelierVariableName"></td>
            </tr>
            <tr>
              <td class="TexteC">Image liée (.png): </td>
              <td class="TexteC"><input type="file" name="SendImage"></td>
            </tr>
            <tr>
              <input type="hidden" name="InsertWhat" value="AddAtelier">
              <td class="TexteC" colspan="2"><input style="width:100px" type="submit" name="envoyer" value="Ajouter Atelier"></td>
            </tr>
          </form>
          <!--//Formulaire pour effacer un atelier-->
          <form method="POST" action="FonctionsPHP/BDDDelete.php" enctype="multipart/form-data">
            <tr>
              <td colspan="2" class="TexteC"><br></td>
            </tr>
            <tr>
              <td colspan=2 class="TexteCB">Atelier à Supprimmer: </td>
            </tr>
            <tr>
              <td class="TexteC">Nom (celui affiché): </td>
              <td class="TexteC"><input name="DeleteAtelierName"></td>
            </tr>
            <tr>
              <input type="hidden" name="DeleteWhat" value="DeleteAtelier">
              <td class="TexteC" colspan="2"><input style="width:100px" type="submit" name="envoyer" value="Effacer Atelier"></td>
            </tr>
          </form>
          <!--//Formulaire pour ajouter un outil-->
          <form method="POST" action="FonctionsPHP/BDDInsert.php" enctype="multipart/form-data">
            <tr>
              <td colspan="2" class="TexteC"><br></td>
            </tr>
            <tr>
              <td colspan="2" class="TexteCB">Outil à Ajouter: </td>
            </tr>
            <tr>
              <td class="TexteC">Nom à afficher: </td>
              <td class="TexteC"><input name="AddOutilName"></td>
            </tr>
            <tr>
              <td class="TexteC">Nom de la variable <br>(sans caractère spéciaux, éspace, ...): </td>
              <td class="TexteC"><input name="AddOutilVariableName"></td>
            </tr>
            <tr>
              <td class="TexteC">Image liée (.png): </td>
              <td class="TexteC"><input type="file" name="SendImage"></td>
            </tr>
            <tr>
              <input type="hidden" name="InsertWhat" value="AddOutil">
              <td colspan="2"><input style="width:100px" type="submit" name="envoyer" value="Ajouter Outil"></td>
            </tr>
          </form>
          <!--//Formulaire pour effacer un outil-->
          <form method="POST" action="FonctionsPHP/BDDDelete.php" enctype="multipart/form-data">
            <tr>
              <td colspan="2" class="TexteC"><br></td>
            </tr>
            <tr>
              <td colspan="2" class="TexteCB">Outil à Supprimmer: </td>
            </tr>
            <tr>
              <td class="TexteC">Nom (celui affiché): </td>
              <input type="hidden" name="DeleteWhat" value="DeleteOutil">
              <td class="TexteC"><input name="DeleteOutilName"></td>
            </tr>
            <tr>
              <input type="hidden" name="DeleteWhat" value="DeleteOutil">
              <td class="TexteC" colspan="2"><input style="width:100px" type="submit" name="envoyer" value="Effacer Outil"></td>
            </tr>
          </form>
          <!--//Formulaire pour ajouter un sujet-->
          <form method="POST" action="FonctionsPHP/BDDInsert.php" enctype="multipart/form-data">
            <tr>
              <td colspan="2" class="TexteC"><br></td>
            </tr>
            <tr>
              <td colspan="2" class="TexteCB">Sujet à Ajouter: </td>
            </tr>
            <tr>
              <td class="TexteC">Nom à afficher: </td>
              <td class="TexteC"><input name="AddSujetName"></td>
            </tr>
            <tr>
              <td class="TexteC">Nom de la variable <br>(sans caractère spéciaux, éspace, ...): </td>
              <td class="TexteC"><input name="AddSujetVariableName"></td>
            </tr>
            <tr>
              <td class="TexteC">Image liée (.png): </td>
              <td class="TexteC"><input type="file" name="SendImage"></td>
            </tr>
            <tr>
              <input type="hidden" name="InsertWhat" value="AddSujet">
              <td class="TexteC" colspan="2"><input style="width:100px" type="submit" name="envoyer" value="Ajouter Sujet"></td>
            </tr>
          </form>
          <!--//Formulaire pour effacer un sujet -->
          <form method="POST" action="FonctionsPHP/BDDDelete.php" enctype="multipart/form-data">
            <tr>
              <td colspan="2" class="TexteC"><br></td>
            </tr>
            <tr>
              <td colspan=2 class="TexteCB">Sujet à Supprimmer: </td>
            </tr>
            <tr>
              <td class="TexteC">Nom (celui affiché): </td>
              <td class="TexteC"><input name="DeleteSujetName"></td>
            </tr>
            <tr>
              <input type="hidden" name="DeleteWhat" value="DeleteSujet">
              <td class="TexteC" colspan="2"><input style="width:100px" type="submit" name="envoyer" value="Effacer Sujet"></td>
            </tr>
          </form>

        </table>





        <table border="1" width=100%>
          <tr>
          </tr>
        </table>
        <br>


        <?php
        ////////////////////////////////////////////////////////////////////////////
        //Envoi d'info à tous les membres
        ////////////////////////////////////////////////////////////////////////////
        ?>
        <p class="SousSousTitreC">Envoi Info Générale</p>

        <div>
          <form class="form-horizontal" action="FonctionsPHP/ExcelGenerator.php" method="post" name="upload_excel"
            enctype="multipart/form-data">
            <input type="submit" name="Export" class="btn btn-success" value="Export CSV pour Newsletter"/>
          </form>
        </div>


        <table border="0" width=100%>
          <form method="POST" action="FonctionsPHP/EmailSend.php" enctype="multipart/form-data">
            <tr>
              <td class="TexteC" width=25%>Titre: </td>
              <td class="TexteC" width=75%><input name="Titre" type="VarChar" size=30></td>
            </tr>

            <tr>
              <td class="TexteC">Fichier Image principale <br> (max 1Mo, seulement .jpg) : </td>
            </tr>
            <tr>
              <td><input type="file" name="SendImage"></td>
            </tr>
            <tr>
              <td class="TexteC">Info principale: </td>
              <td><textarea class="TexteC" name="InfoPrincipale" type="VarChar" rows="8" cols="45"></textarea></td>
            </tr>
              <td class="TexteC">Titre sous-chapitre: </td>
              <td class="TexteC"><input name="TitreSousChap" type="VarChar" size=30></td>
            </tr>
            <tr>
              <td class="TexteC">Sous-chapitre: </td>
              <td><textarea class="TexteC" name="SousChap" type="VarChar" rows="8" cols="45"></textarea></td>
            </tr>
            <input type="hidden" name="WhichEmail" value="InfoGenerale">
            <td class="TexteC"><input style="width:100px" type="submit" name="envoyer" value="Envoi email"></td>
          </form>

        </table>



        <?php
      }
    }














    function MembrePersoKO($message){
      /////////////////////////////////////////////////////////////////////////
      //Connextion espace membre
      /////////////////////////////////////////////////////////////////////////
      ?>
      <p class="SousTitreC"> Espace Membre </p>
      <br>

      <p class="SousSousTitreC"> Déjà membre? Connectez-vous à votre éspace membre ici: </p>
      <!--//Formulaire pour le login des membres-->
      <form action="EspaceMembres.php" method="post">
        <table border="0" align="center" width=40%>
          <tr>
            <td colspan="2" class="TexteC"><?php echo $message ?></td>
          </tr>
          <tr>
            <td class="TexteC" width=30%>Login :</td>
            <td class="TexteC" width=70%><input size="20" type="text" name="Login"></td>
          </tr>
          <tr>
            <td class="TexteC">Mot de passe :</td>
            <td class="TexteC"><input size="20" type="password" name="Pw"></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input style="width:100px" type="submit" name="soumettre" value="Se connecter"></td>
          </tr>
        </table>
      </form>
      <br>
      <p class="SousSousTitreC"> Pas encore membre, inscris-toi ici: </p>
      <!--//Formulaire pour l'inscription d'un nouveau membre-->
      <form action="FonctionsPHP/BDDInsert.php" method="post">
        <table border="0" align="center" width=60%>
          <tr>
            <td class="TexteC" width=15%>Login :</td>
            <td colspan="2" class="TexteC" width=30%><input size="20" type="text" name="Login"></td>
            <td class="TexteC" width=25%>Mot de passe :</td>
            <td colspan="2" class="TexteC" width=30%><input size="20" type="password" name="Pw"></td>
          </tr>
          <tr>
            <td class="TexteC">Prénom :</td>
            <td colspan="2" class="TexteC"><input size="20" type="text" name="Prenom"></td>
            <td class="TexteC">Nom :</td>
            <td colspan="2" class="TexteC"><input size="20" type="text" name="Nom"></td>
          </tr>
          <tr>
            <td class="TexteC">Email :</td>
            <td colspan="5" class="TexteC"><input size="50" type="text" name="Email"></td>
          </tr>
          <tr>
            <td colspan="3" class="TexteC">Inscription Newsletter mensuelle :</td>
            <td class="TexteC"><input type="checkbox" name=Newsletter value=Newsletter></td>
          </tr>
          <tr>
            <td colspan="6" class="TexteC">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" class="TexteC">Outils : </td>
            <td colspan="3" class="TexteC">Sujets : </td>
          </tr>
          <tr>
            <?php
            //Requête pour récupérer le choix d'outils
            $resultOutils = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableOutils ORDER BY ID");
            //Requête pour récupérer le choix de sujets
            $resultSujets = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableSujets ORDER BY ID");
            ?>
            <td colspan="3" class="TexteC" valign="top">
              <?php while ($ligne = mysqli_fetch_array($resultOutils)){ ?>
                <input type="checkbox" name=<?php echo $ligne["OutilVariableName"]?> value=<?php echo "OUTIL_".$ligne["OutilVariableName"]?>><?php echo $ligne["OutilName"]?><br>
              <?php } ?>
            </td>
            <td colspan="3" class="TexteC" valign="top">
              <?php while ($ligne = mysqli_fetch_array($resultSujets)){ ?>
                <input type="checkbox" name=<?php echo $ligne["SujetVariableName"]?> value=<?php echo "SUJET_".$ligne["SujetVariableName"]?>><?php echo $ligne["SujetName"]?><br>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <input type="hidden" name="InsertWhat" value="NewMember">
            <td colspan="6" align="center"><input style="width:100px" type="submit" name="soumettre" value="S'enregistrer"></td>
          </tr>
        </table>
      </form>
      <?php
    }
    ?>
