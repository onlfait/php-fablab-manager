<?php printHeader(); ?>

<section class="body">
  <h1>Members</h1>
  <?php $members = dbSelectArray('login', 'members'); ?>
  <?php foreach ($members as $member) { ?>
    <div class="membre"><?php echo($member['login']) ?></div>
  <?php } ?>
</section>
<!-- end .main .body -->

<?php printFooter(); ?>
