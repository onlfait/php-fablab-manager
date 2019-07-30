<?php routerInclude('layout/header.php') ?>

<section class="section error">
  <article class="message is-danger">
    <div class="message-header">
      <p><?php echo($title) ?></p>
    </div>
    <?php if (!is_null($message)) { ?>
    <div class="message-body">
      <?php echo($message) ?>
    </div>
  <?php } ?>
  </article>
</section>

<?php routerInclude('layout/footer.php') ?>
