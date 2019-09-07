<?php
  // include events functions
  require_once PFM_ROOT_PATH . 'functions/events.php';

  // get all events
  $pfm_events = pfm_get_events();

  // DEBUG
  $_SESSION['AdminMembre'] = 0;
?>

<section>

  <h1 class="title">Evénements</h1>

  <?php while ($event = pfm_fetch_event($pfm_events)) { ?>

    <h2 class="title"><?php echo $event->Titre ?> (<?php echo $event->id ?>)</h2>
    <div><img class="responsive" src="Upload/EventImage/<?php echo $event->id?>.jpg" /></div>
    <div>Lieu: <?php echo $event->Lieu ?></div>
    <div>Début: <?php echo $event->HeureDebut ?></div>
    <div>Fin: <?php echo $event->HeureFin ?></div>

    <div><?php echo $event->Description ?></div>
    <div><img src="Image/Picto/Atelier_<?php echo $event->Ateliers ?>.png" height="100"></div>
    <div><img src="FonctionsPHP/ImageGD.php?text1=<?php echo $event->Age ?>ans&text2=Age min" alt="Age" height="100"></div>
    <div><img src="FonctionsPHP/ImageGD.php?text1=<?php echo $event->PrixMembre ?>CHF&text2=Membre" alt="PrixMembre" height="100"></div>
    <div><img src="FonctionsPHP/ImageGD.php?text1=<?php echo $event->PrixNonMembre ?>CHF&text2=Non-Membre" alt="PrixNonMembre" height="100"></div>

  <?php } // while => $event ?>

</section>
