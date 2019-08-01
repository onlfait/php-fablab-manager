<?php userLogout(); ?>

<?php routerInclude('layout/header.php') ?>

<section class="section">
  <article class="message is-success">
    <div class="message-header">
      <p><?php textPrint('Log out') ?></p>
    </div>
    <div class="message-body">
      <?php textPrint('You are disconnected.') ?>
    </div>
  </article>
</section>

<?php routerInclude('layout/footer.php') ?>
