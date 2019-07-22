<?php printHeader(); ?>

<section class="section">
  <h1><?php _e('Members'); ?></h1>
  <?php $members = dbSelectArray('login', 'members'); ?>
  <?php if (count($members) === 0) { ?>
    <div class="member">
      <p><?php _e('No members found.'); ?></p>
    </div>
  <?php } else { ?>
    <?php foreach ($members as $member) { ?>
      <div class="member"><?php echo($member['login']) ?></div>
    <?php } ?>
  <?php } ?>
</section>

<?php printFooter(); ?>
