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

  <div class="grid">

  <?php while ($event = pfm_fetch_event($pfm_events)) { ?>

    <div class="cell cell-12 cell-desktop-6 pad">

      <h2 class="title"><?php echo $event->Titre ?> (<?php echo $event->id ?>)</h2>
      <img class="responsive" src="Upload/EventImage/<?php echo $event->id?>.jpg" />

      <div class="cell h-spacer height-x5"></div>

      <div class="grid">
        <div class="cell cell-12 cell-desktop-6">
          <div><?php echo $event->Description ?></div>
          <div>Lieu: <?php echo $event->Lieu ?></div>
          <div>Début: <?php echo $event->HeureDebut ?></div>
          <div>Fin: <?php echo $event->HeureFin ?></div>
        </div>
        <div class="cell cell-12 cell-desktop-6">
          <div>
            <?php pfm_print_picto_img('Atelier_' . $event->Ateliers) ?>
            <?php pfm_print_picto('Age min.', $event->Age . 'ans', true) ?>
            <?php pfm_print_picto('Age min.', $event->PrixMembre . ' CHF', true) ?>
            <?php pfm_print_picto('Age min.', $event->PrixNonMembre . ' CHF', true) ?>
          </div>
        </div>
      </div>

    </div>

  <?php } // while => $event ?>

  </div>

</section>
