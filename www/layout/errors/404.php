<?php printHeader(); ?>

<section class="body error">
  <h1 class="title">Oups !</h1>
  <?php if (!is_null($errorMessage)) { ?>
    <p class="message"><?php echo($errorMessage) ?></p>
  <?php } ?>
</section>
<!-- end .main .body.error -->

<?php printFooter(); ?>
