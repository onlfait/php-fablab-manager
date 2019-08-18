<div id="content" >
<div id="centercolumn">

  <p class="SousTitreC"> Projet Membres </p>

  <?php
  //Connection à la BDD
  include("FonctionsPHP/BDDConnect.php");

  //Requête pour récupérer les données des projets des membres
  $result = mysqli_query($connect,"SELECT * FROM $TableProjetPerso ORDER BY DateSave DESC");


  while ($ligne = mysqli_fetch_array($result)){
    ?>
    <table border="0" class="Texte" align="center" valign="top" width="100%">
      <?php
      if ($ligne["NoMembre"]==$_SESSION['IDLogin']){
        //Dans ce cas les projets sont en mode édition
        ?>
        <form method="POST" action="FonctionsPHP/BDDUpdate.php" enctype="multipart/form-data">
          <input name="Variable2Change" type="hidden" size=20 value="ProjetMembre">
          <input name="ID" type="hidden" size=20 value="<?php printf("%s", $ligne["ID"]);?>">
          <tr>
            <td colspan="4" class="SousTitreC"><input name="Titre" type="VarChar" size=20 value="<?php printf("%s", $ligne["Titre"]);?>"> (<?php printf("%s", $ligne["ID"]);?>)</td>
          </tr>
          <tr>
            <td colspan="2" class="TexteC" width="50%">Enregistré par le membre : <?php printf("%s", $ligne["NoMembre"]);?></td>
            <td class="TexteC" width="25%">Enregistré le : <?php printf("%s", $ligne["DateSave"]);?></td>
            <?php
            if($ligne["ZipFile"]==1){
              ?>
              <td class="TexteC"><a href=<?php echo 'Upload/ProjetZip/'. $ligne["ID"] . '.zip' ?> ><img src=<?php echo 'Image/Icone/ZipFile.jpg' ?> width="40"/></td>
                <?php
              }else{
                ?>
                <td class="TexteC"></td>
                <?php
              }?>
            </tr>
            <tr>
              <td colspan="3" class="TexteC"></td>
              <td><input type="file" name="SendZip"></td>
            </tr>
            <tr>
              <td colspan="2" class="TexteC"><img src=<?php echo 'Upload/ProjetImage/'. $ligne["ID"] . '.jpg' ?> width="300"/></td>
              <td colspan="2"><textarea class="TexteC" name="Description" type="VarChar" rows="8" cols="45"><?php printf("%s", $ligne["Description"]);?></textarea></td>
            </tr>
            <tr>
              <td colspan="2"><input type="file" name="SendImage"></td>
            </tr>
            <tr>
              <td height="80" align="left" valign="center" class="TexteC" width="15%">Outils :</td>
              <td colspan=3 align="left" valign="center" class="TexteC" width="85%">
                <?php
                //Requête pour récupérer les outils liés à chaque projet
                $resultLiaison = mysqli_query($connect,"SELECT * FROM $TableLiaison WHERE IDProjet='$ligne[ID]' AND Outils IS NOT NULL");
                while ($row = mysqli_fetch_array($resultLiaison)){
                  $ImagePath="Image/Picto/Outil_" . $row["Outils"] . ".png" ?>
                  <img src=<?php echo $ImagePath; ?> height="75">
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td class="TexteC" valign="top" colspan=4>
                <?php
                //Requête pour récupérer le choix de outils
                $resultOutils = mysqli_query($connect,"SELECT * FROM $TableOutils ORDER BY ID");
                while ($rowAll = mysqli_fetch_array($resultOutils)){
                  $rowAllTemp=$rowAll["OutilVariableName"];

                  $checked=0;
                  $resultLiaison = mysqli_query($connect,"SELECT * FROM $TableLiaison WHERE IDProjet='$ligne[ID]' AND Outils IS NOT NULL");
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
            </tr>
            <tr>
              <td height="80" align="left" valign="center" class="TexteC">Sujet :</td>
              <td colspan=3 align="left" valign="center" class="TexteC">
                <?php
                //Requête pour récupérer les sujets liés à chaque projet
                $resultLiaison = mysqli_query($connect,"SELECT * FROM $TableLiaison WHERE IDProjet='$ligne[ID]' AND Sujets IS NOT NULL");
                while ($row = mysqli_fetch_array($resultLiaison)){
                  $ImagePath="Image/Picto/Sujet_" . $row["Sujets"] . ".png"?>
                  <img src=<?php echo $ImagePath; ?> height="75">
                  <?php
                }?>
              </td>
            </tr>
            <tr>
              <td class="TexteC" valign="top" colspan=4>
                <?php
                //Requête pour récupérer le choix de sujets
                $resultSujets = mysqli_query($connect,"SELECT * FROM $TableSujets ORDER BY ID");
                while ($rowAll = mysqli_fetch_array($resultSujets)){
                  $rowAllTemp=$rowAll["SujetVariableName"];

                  $checked=0;
                  $resultLiaison = mysqli_query($connect,"SELECT * FROM $TableLiaison WHERE IDProjet='$ligne[ID]' AND Sujets IS NOT NULL");
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
            </tr>
            <tr>
              <td colspan="4" class="TexteC">Info: Pour ne pas afficher ce projet en mode édition, déconnectez-vous de votre session dans la page Espace Membres</td>
            </tr>
            <tr>
              <td colspan="4" class="TexteC"><input style="width:170px" type="submit" name="miseajour" value="Mettre à jour"></td>
            </tr>
          </form>
          <form method="POST" action="FonctionsPHP/BDDDelete.php" enctype="multipart/form-data">
            <tr>
              <?php
              if($ligne["ZipFile"]==1){
                ?>
                <input name="DeleteWhat" type="hidden" size=20 value="ZipFile">
                <input name="ID" type="hidden" size=20 value="<?php printf("%s", $ligne["ID"]);?>">
                <td colspan="4" class="TexteC"><input style="width:170px" type="submit" name="SuppressZip" value="Supprimer Fichier Zip"></td>
                <?php
              }?>
            </tr>
          </form>
          <form method="POST" action="FonctionsPHP/BDDDelete.php" enctype="multipart/form-data">
            <tr>
              <input name="DeleteWhat" type="hidden" size=20 value="ProjetMembre">
              <input name="ZipFile" type="hidden" size=20 value="<?php printf("%s", $ligne["ZipFile"]);?>">
              <input name="IDProjet" type="hidden" size=20 value="<?php printf("%s", $ligne["ID"]);?>">
              <td colspan="4" class="TexteC"><input style="width:170px" type="submit" name="SupprimerProjet" value="Supprimer le projet"></td>
            </tr>
          </form>
          <?php
        }else {
          //Dans ce cas les projets sont en mode lecture
          ?>
          <tr>
            <td colspan="4" class="SousTitreC"><?php printf("%s", $ligne["Titre"]);?> (<?php printf("%s", $ligne["ID"]);?>)</td>
          </tr>
          <tr>
            <td colspan="2" class="TexteC" width="50%">Enregistré par le membre : <?php printf("%s", $ligne["NoMembre"]);?></td>
            <td class="TexteC" width="25%">Enregistré le : <?php printf("%s", $ligne["DateSave"]);?></td>
            <?php
            if($ligne["ZipFile"]==1){
              ?>
              <td class="TexteC"><a href=<?php echo 'Upload/ProjetZip/'. $ligne["ID"] . '.zip' ?> ><img src=<?php echo 'Image/Icone/ZipFile.jpg' ?> width="40"/></td>
                <?php
              }else{
                ?>
                <td class="TexteC"></td>
                <?php
              }?>
            </tr>
            <tr>
              <td colspan="2" class="TexteC"><img src=<?php echo 'Upload/ProjetImage/'. $ligne["ID"] . '.jpg' ?> width="300"/></td>
              <td name="Description" colspan="2" class="TexteC" width="50%"><?php printf("%s", $ligne["Description"]);?></td>
            </tr>
            <tr>
              <td height="80" align="left" valign="center" class="TexteC" width="15%">Outils :</td>
              <td colspan=3 align="left" valign="center" class="TexteC" width="85%">
                <?php
                //Requête pour récupérer les outils liés à chaque projet
                $resultLiaison = mysqli_query($connect,"SELECT * FROM $TableLiaison WHERE IDProjet='$ligne[ID]' AND Outils IS NOT NULL");
                while ($row = mysqli_fetch_array($resultLiaison)){
                  $ImagePath="Image/Picto/Outil_" . $row["Outils"] . ".png" ?>
                  <img src=<?php echo $ImagePath; ?> height="75">
                <?php }
                ?>
              </td>
            </tr>
            <tr>
              <td height="80" align="left" valign="center" class="TexteC" width="15%">Sujet :</td>
              <td colspan=3 align="left" valign="center" class="TexteC" width="85%">
                <?php
                //Requête pour récupérer les sujets liés à chaque projet
                $resultLiaison = mysqli_query($connect,"SELECT * FROM $TableLiaison WHERE IDProjet='$ligne[ID]' AND Sujets IS NOT NULL");
                while ($row = mysqli_fetch_array($resultLiaison)){
                  $ImagePath="Image/Picto/Sujet_" . $row["Sujets"] . ".png" ?>
                  <img src=<?php echo $ImagePath; ?> height="75">
                <?php }
                ?>
              </td>
            </tr>
            <?php
          }
          ?>
          <tr>
            <td colspan="4" height="30px" bgcolor="#303745"></td>
          </tr>
        </table>
        <?php
      }
      //Fermeture de BDD
      mysqli_close($connect);
      ?>


    </div><!-- #centercolumn -->
  </div><!-- #content -->
