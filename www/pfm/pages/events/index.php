<?php
  // include events functions
  require_once PFM_PATH . 'functions/events.php';

  // get all events
  $pfm_events = pfm_get_events();
?>

<section>
  <div class="grid">
  <?php while ($event = pfm_fetch_event($pfm_events)): ?>
    <div class="cell cell-12 cell-desktop-6 pad-x2">
      <img class="responsive" src="<?php echo pfm_public_url('images/events/' . $event->image) ?>" />
      <h2 class="title h-pad-x0 bg-primary text-secondary text-center"><?php echo $event->title ?></h2>
      <div class="grid bg-secondary pad-x2">
        <div class="cell cell-12">
          <div><?php echo $event->description ?></div>
          <div>Lieu: <?php echo $event->location ?></div>
          <div>Début: <?php echo $event->start_time ?></div>
          <div>Fin: <?php echo $event->end_time ?></div>
        </div>
        <div class="cell h-spacer height-x2"></div>
        <div class="cell cell-12 cell-desktop-6">
          <?php pfm_print_picto_svg($event->category_image, '#F2EACC', '#182722') ?>
          <?php pfm_print_picto('Age min.', $event->age_min . ' ans', true) ?>
          <?php pfm_print_picto('Membre', $event->member_price . ' CHF', true) ?>
          <?php pfm_print_picto('Non-Membre', $event->price . ' CHF', true) ?>
        </div>
        <div class="cell cell-12 cell-desktop-6">
        <?php
          foreach ($event->Sujets as $row) {
            pfm_print_picto_img('Sujet_' . $row->Sujets);
          }
          foreach ($event->Outils as $row) {
            pfm_print_picto_img('Outil_' . $row->Outils);
          }
        ?>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
  </div>
</section>
