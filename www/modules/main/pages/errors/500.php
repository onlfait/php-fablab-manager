<?php routerInclude('layout/header.php') ?>

<section class="section error">
  <article class="message is-danger">
    <div class="message-header">
      <p><?php statePrint('error.title') ?></p>
    </div>
    <div class="message-body">
      <?php if (stateGet('error.message')) {
        statePrint('error.message');
      } else {
        textPrint('Internal server error.');
      } ?>
    </div>
  </article>
</section>

<?php routerInclude('layout/footer.php') ?>
