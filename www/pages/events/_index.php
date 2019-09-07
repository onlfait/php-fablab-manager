<?php
  // include events functions
  require_once PFM_ROOT_PATH . 'functions/events.php';

  // get all events
  $pfm_events = pfm_get_events();

  // DEBUG
  $_SESSION['AdminMembre'] = 0;
?>

<div id="content" >
  <div id="centercolumn">
    <p class="SousTitreC"> Ateliers et Evénements </p>

    <?php
    while ($event = pfm_fetch_event($pfm_events)) {
      ?>
      <table border="0" class="Texte" align="center" width="100%">
        <?php if($_SESSION['AdminMembre']==1){
          //Si le membre est un membre admin, l'event est en mode édition ?>
        <form method="POST" action="FonctionsPHP/BDDUpdate.php" enctype="multipart/form-data">
          <tr>
            <td colspan="2" class="SousTitreC"><input name="Titre" size=20 value="<?php echo $event->Titre ?>">(<?php echo $event->id ?>)</td>
            <td colspan="2" class="SousTitreC">Lieu: <input name="Lieu" size=20 value="<?php echo $event->Lieu ?>"></td>
          </tr>
          <tr>
            <td colspan="2" class="TexteC"><img src=<?php echo 'Upload/EventImage/'. $event->id . '.jpg' ?> width="300"/></td>
            <td align="center" class="TexteC">Début: <br><input name="HeureDebut" size=20 value="<?php echo $event->HeureDebut ?>"></td>
            <td align="center" class="TexteC">Fin: <br><input name="HeureFin" size=20 value="<?php echo $event->HeureFin ?>"></td>
          </tr>
          <tr>
            <td colspan="2"><input type="file" name="SendImage"></td>
          </tr>
          <tr>
            <td colspan="4"><textarea class="TexteC" name="Description" type="VarChar" rows="8" cols="45"><?php echo $event->Description ?></textarea></td>
          </tr>
          <tr>
            <td align="center" width="25%"><img src="Image/Picto/Atelier_<?php echo $event->Ateliers ?>.png" height="100"></td>
            <td align="center" width="25%"><img src="FonctionsPHP/ImageGD.php?text1=<?php echo $event->Age." ans" ?>&text2=Age min" alt="Age" height="100"></td>
            <td align="center" width="25%"><img src="FonctionsPHP/ImageGD.php?text1=<?php echo $event->PrixMembre."CHF"?>&text2=Membre" alt="PrixMembre" height="100"></td>
            <td align="center" width="25%"><img src="FonctionsPHP/ImageGD.php?text1=<?php echo $event->PrixNonMembre."CHF" ?>&text2=Non-Membre" alt="PrixNonMembre" height="100"></td>
          </tr>
          <tr>
            <?php
            //Requête pour récupérer le choix d'ateliers
            $resultMenuAteliers = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableAteliers ORDER BY ID");
            ?>
            <td class="TexteC">
              <select size="1" name="Atelier">
                <?php while ($eventMenuAtelier = mysqli_fetch_array($resultMenuAteliers)){ ?>
                  <option value=<?php echo "ATELIER_".$eventMenuAtelier["AtelierVariableName"]?>><?php echo $eventMenuAtelier["AtelierName"]?></option>
                <?php } ?>
              </select>
            </td>
            <td align="center" class="TexteC"><input name="Age" size=20 value="<?php echo $event->Age ?>"></td>
            <td align="center" class="TexteC"><input name="PrixMembre" size=20 value="<?php echo $event->PrixMembre ?>"></td>
            <td align="center" class="TexteC"><input name="PrixNonMembre" size=20 value="<?php echo $event->PrixNonMembre ?>"></td>
          </tr>
          <tr>
            <td height="80" align="left" valign="center" class="TexteC" width="15%">Outils :</td>
            <td colspan=3 align="left" valign="center" class="TexteC" width="85%">
              <?php
              foreach ($event->Outils as $row) {
                $ImagePath="Image/Picto/Outil_" . $row->Outils . ".png" ?>
                <img src=<?php echo $ImagePath; ?> height="75">
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td class="TexteC" valign="top" colspan=4>
              <?php
              //Requête pour récupérer le choix de outils
              $resultOutils = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableOutils ORDER BY ID");
              while ($rowAll = mysqli_fetch_array($resultOutils)){
                $rowAllTemp=$rowAll["OutilVariableName"];

                $checked=0;
                foreach ($event->Outils as $row) {
                  $rowTemp=$row->Outils;
                  if($rowAllTemp==$rowTemp) {
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
          </tr>
          <tr>
            <td height="80" align="left" valign="center" class="TexteC">Sujet :</td>
            <td colspan=3 align="left" valign="center" class="TexteC">
              <?php
              //Requête pour récupérer les sujets liés à chaque event
              foreach ($event->Sujets as $row) {
                $ImagePath="Image/Picto/Sujet_" . $row->Sujets . ".png"?>
                <img src=<?php echo $ImagePath; ?> height="75">
                <?php
              }?>
            </td>
          </tr>
          <tr>
            <td class="TexteC" valign="top" colspan=4>
              <?php
              //Requête pour récupérer le choix de sujets
              $resultSujets = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableSujets ORDER BY ID");
              while ($rowAll = mysqli_fetch_array($resultSujets)){
                $rowAllTemp=$rowAll["SujetVariableName"];

                $checked=0;
                foreach ($event->Sujets as $row) {
                  $rowTemp=$row->Sujets;
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
          </tr>
          <tr>
            <input name="Variable2Change" type="hidden" size=20 value="Event">
            <input name="IDEvent" type="hidden" size=20 value="<?php echo $event->id ?>">
            <td colspan="4" class="TexteC"><input style="width:170px" type="submit" name="MiseAJour" value="Mettre à jour"></td>
          </tr>
        </form>
        <form method="POST" action="FonctionsPHP/BDDDelete.php" enctype="multipart/form-data">
          <tr>
            <input name="DeleteWhat" type="hidden" size=20 value="Event">
            <input name="IDEvent" type="hidden" size=20 value="<?php echo $event->id ?>">
            <td colspan="4" class="TexteC"><input style="width:170px" type="submit" name="SupprimerEvent" value="Supprimer l'événement"></td>
          </tr>
        </form>

      <?php } else { // $_SESSION['AdminMembre'] == 0

          //Si le membre n'est pas un membre admin, l'event est en lecture seul ?>
          <tr>
            <td colspan="2" class="SousTitreC"><?php echo $event->Titre ?> (<?php echo $event->id ?>)</td>
            <td colspan="2" class="SousTitreC">Lieu: <?php echo $event->Lieu ?></td>
          </tr>
          <tr>
            <td colspan="2" class="TexteC"><img src=<?php echo 'Upload/EventImage/'. $event->id . '.jpg' ?> width="300"/></td>
            <td class="SousSousTitreC">Début: <br><?php echo $event->HeureDebut ?></td>
            <td class="SousSousTitreC"> Fin: <br><?php echo $event->HeureFin ?></td>
          </tr>
          <tr>
            <td colspan="4" class="TexteC"><?php echo $event->Description ?></td>
          </tr>
          <tr>
            <td align="center" width="25%"><img src="Image/Picto/Atelier_<?php echo $event->Ateliers ?>.png" height="100"></td>
            <td align="center" width="25%"><img src="FonctionsPHP/ImageGD.php?text1=<?php echo $event->Age." ans" ?>&text2=Age min" alt="Age" height="100"></td>
            <td align="center" width="25%"><img src="FonctionsPHP/ImageGD.php?text1=<?php echo $event->PrixMembre."CHF"?>&text2=Membre" alt="PrixMembre" height="100"></td>
            <td align="center" width="25%"><img src="FonctionsPHP/ImageGD.php?text1=<?php echo $event->PrixNonMembre."CHF" ?>&text2=Non-Membre" alt="PrixNonMembre" height="100"></td>
          </tr>
          <tr>
            <td height="80" align="left" valign="center" class="TexteC">Sujet :
            </td>
            <td colspan=3 align="left" valign="center" class="TexteC">
              <?php
              foreach ($event->Sujets as $row) {
                $ImagePath="Image/Picto/Sujet_" . $row->Sujets . ".png" ?>
                <img src=<?php echo $ImagePath; ?> height="75">
              <?php }
              ?>
            </td>
          </tr>
          <tr>
            <td height="80" align="left" valign="center" class="TexteC">Outils :
            </td>
            <td colspan=3 align="left" valign="center" class="TexteC">
              <?php
              foreach ($event->Outils as $row) {
                $ImagePath="Image/Picto/Outil_" . $row->Outils . ".png" ?>
                <img src=<?php echo $ImagePath; ?> height="75">
              <?php }
              ?>
            </td>
          </tr>
      <?php } ?>
          <!--//Formulaire pour l'envoi des inscriptions-->
          <form action="FonctionsPHP/AtelierFct.php" method="post">
          <tr>
            <td class="TexteC">Nom<br><input type="text" size="15" name="Nom"></td>
            <td class="TexteC">Prénom<br><input type="text" size="15" name="Prenom"></td>
            <td colspan="2" class="TexteC">Email<br><input type="text" size="50" name="Email"></td>
          </tr>
          <tr>
            <?php
            if ($event->PlaceDispo==0){
              ?>
              <td colspan="2" class="TexteC"></td>
              <td colspan="2" class="TexteC">Complet</td>
              <?php
            }else{
              ?>
              <input type="hidden" name="id" value="<?php echo $event->id ?>"></td>
              <input type="hidden" name="Titre" value="<?php echo $event->Titre ?>"></td>
              <input type="hidden" name="Lieu" value="<?php echo $event->Lieu ?>"></td>
              <input type="hidden" name="HeureDebut" value="<?php echo $event->HeureDebut ?>"></td>
              <input type="hidden" name="HeureFin" value="<?php echo $event->HeureFin ?>"></td>
              <td colspan="2" class="TexteC"><input style="width:100px" type="submit" name="soumettre" value="S'inscrire"></td>
              <td colspan="2" class="TexteC">Places disponibles : <?php echo $event->PlaceDispo ?>/<?php echo $event->PlaceMax ?></td>
              <?php
            }
            ?>
          </tr>
          <tr>
            <td colspan="4" height="30px" bgcolor="#303745"></td>
          </tr>
        </form>
      </table>

      <?php
    }
    ?>


  </div><!-- #centercolumn -->
</div><!-- #content -->
