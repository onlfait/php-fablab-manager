<?php 

include("SecurePOST2BDD.php");

$Info2Get = securite_bdd($_POST['Info2Get']);

//Connection à la BDD


if($Info2Get=="ParticipantAtelier"){

  $NumeroAtelier = securite_bdd($_POST['NumeroAtelier']);
  //Requête pour lire les inscriptions à l'atelier
  $result = mysqli_query($PFM['db']['link'],"SELECT Nom, Prenom, Email FROM $TableInscrEvent WHERE NoEvent='$NumeroAtelier'");

}elseif($Info2Get=="DonneeMembreByAdmin"){

  $IDMembre = securite_bdd($_POST['IDMembre']);
  //Requête pour lire les inscriptions à l'atelier
  $result = mysqli_query($PFM['db']['link'],"SELECT * FROM $TableMembres WHERE ID='$IDMembre'");
}
?>






<!-- Page de confirmation-->
<html>
<head>
  <title>Lecture des BDD</title>
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
    if($Info2Get=="ParticipantAtelier"){ ?>
      <p class="SousSousTitreC">Liste des participants</p>
      <table border="0" width=50%>
        <?php
        while ($row = mysqli_fetch_array($result)){ ?>
          <tr>
            <td class="TexteC" width=33%><?php echo $row["Nom"];?></td>
            <td class="TexteC" width=33%><?php echo $row["Prenom"];?></td>
            <td class="TexteC" width=33%><?php echo $row["Email"];?></td>
          </tr>
        <?php } ?>
      </table>
      <?php
    }elseif($Info2Get=="DonneeMembreByAdmin"){?>
      <?php $row = mysqli_fetch_array($result) ?>
      <p class="SousSousTitreC">Données du membre</p>
      <form action="BDDUpdate.php" method="post">
        <table border="0" width=100%>
          <tr>
            <td class="TexteC" width=50%>N° de Membre</td>
            <td class="TexteC" width=50%><?php echo $row["ID"];?></td>
          </tr>
          <tr>
            <td class="TexteC">Nom</td>
            <td class="TexteC"><?php echo $row["Nom"];?></td>
          </tr>
          <tr>
            <td class="TexteC">Prénom</td>
            <td class="TexteC"><?php echo $row["Prenom"];?></td>
          </tr>
          <tr>
            <td class="TexteC">Date d'inscription</td>
            <td class="TexteC"><?php echo $row["DateInscription"];?></td>
          </tr>
          <tr>
            <td class="TexteC">Echéance cotisation (année - mois - jour)</td>
            <td class="TexteC"><input name="EcheanceCoti" size=20 value="<?php echo $row["EcheanceCoti"];?>"></td>
          </tr>
          <tr>
            <td class="TexteC">Nombre d'heure (heure : minute : seconde)</td>
            <td class="TexteC"><input name="NbreHeure" size=20 value="<?php echo $row["NbreHeure"];?>"></td>
          </tr>
          <tr>
            <td class="TexteC">Membre Admin (0=non / 1=oui)</td>
            <td class="TexteC"><input name="AdminMembre" size=20 value="<?php echo $row["AdminMembre"];?>"></td>
          </tr>
        </table>
        <input name="IDMembre" type="hidden" size=20 value="<?php echo $row["ID"];?>">
        <input name="Variable2Change" type="hidden" size=20 value="DonneeMembreByAdmin">
        <td class="TexteCentre"><input type="submit" value="Modifier" size=20></td>
      </form>

      <form action="BDDDelete.php" method="post">
        <input name="DeleteWhat" type="hidden" size=20 value="Membre">
        <input name="IDMembre" type="hidden" size=20 value=<?php echo $row["ID"];?>>
        <p align="right" class="TexteCentre"><input type="submit" value="Supprimer le Membres" size=20></p>
      </form>
    <?php }?>

    <form action="../EspaceMembres.php">
      <input name="Variable2Change" type="hidden" size=20 value="DonneeMembreByAdmin">
      <td class="TexteCentre"><input type="submit" value="Retour Espace Membres" size=20></td>
    </form>


  </div><!-- #centercolumn -->
</div><!-- #content -->

<?php include("pied_de_page.php"); ?>

</body>
</html>
