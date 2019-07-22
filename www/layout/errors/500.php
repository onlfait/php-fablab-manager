<?php printHeader(); ?>

<section class="section error">
  <article class="message is-danger">
    <div class="message-header">
      <p><?php _e('Oups !'); ?></p>
    </div>
    <?php if (!is_null($errorMessage)) { ?>
    <div class="message-body">
      <?php echo($errorMessage) ?>
    </div>
  <?php } ?>
  </article>
</section>

<?php printFooter(); ?>
