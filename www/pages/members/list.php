<?php printHeader(); ?>

<section class="body">
  <h1>Members</h1>
  <?php $members = dbSelectArray('login', 'members'); ?>
  <?php if (count($members) === 0) { ?>
    <div class="membre">
      <p>No members found...</p>
    </div>
  <?php } else { ?>
    <?php foreach ($members as $member) { ?>
      <div class="membre"><?php echo($member['login']) ?></div>
    <?php } ?>
  <?php } ?>
</section>
<!-- end .main .body -->

<?php printFooter(); ?>
