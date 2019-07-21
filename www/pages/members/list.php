<?php printHeader(); ?>

<section class="body">
  <h1>Members</h1>
  <?php $members = dbSelectArray('Login', 'login'); ?>
  <?php foreach ($members as $member) { ?>
    <div class="membre"><?php echo($member['Login']) ?></div>
  <?php } ?>
</section>
<!-- end .main .body -->

<?php printFooter(); ?>
