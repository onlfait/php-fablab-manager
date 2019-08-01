<?php
extract(userLogin($_POST));
?>

<?php routerInclude('layout/header.php') ?>

<section class="section">
  <div class="container" style="max-width:800px">
    <h1 class="title is-4">// <?php textPrint('Log in') ?></h1>

    <?php if (!empty($errors)) { ?>
    <article class="message is-danger">
      <div class="message-header">
        <p><?php textPrint('Error') ?></p>
      </div>
      <div class="message-body">
        <?php foreach ($errors as $error) { ?>
        <p>- <?php echo($error) ?></p>
        <?php } ?>
      </div>
    </article>
    <?php } ?>

    <form action="<?php echo routerURL('members', 'log-in') ?>" method="post">

      <div class="columns">

        <div class="column">
          <div class="field">
            <p class="control has-icons-left has-icons-right">
              <input class="input" name="email" type="email" placeholder="<?php textPrint('Email') ?>" value="<?php echo($email) ?>">
              <span class="icon has-text-danger is-left">
                <i class="fas fa-envelope"></i>
              </span>
            </p>
          </div>
        </div>

        <div class="column">
          <div class="field">
            <p class="control has-icons-left">
              <input class="input" name="password" type="password" placeholder="<?php textPrint('Password') ?>">
              <span class="icon has-text-danger is-left">
                <i class="fas fa-lock"></i>
              </span>
            </p>
          </div>
        </div>

      </div>

      <div class="columns is-hidden-desktop">
        <div class="column">
          <div class="field">
            <p class="control">
              <button class="button is-success is-fullwidth">
                <?php textPrint('Log in') ?>
              </button>
            </p>
          </div>
        </div>
      </div>

      <div class="columns">
        <div class="column">
          <label class="checkbox has-text-link">
            <input type="checkbox" name="remember-me" value="true" <?php echo($rememberMe) ?>>
            <?php textPrint('Remember me !') ?>
          </label>
        </div>
        <div class="column">
          <a href="<?php echo routerURL('members', 'reset-password') ?>"><?php textPrint('Forgot password ?') ?></a>
        </div>
      </div>

      <div class="columns is-hidden-mobile">
        <div class="column">
          <div class="field">
            <p class="control">
              <button class="button is-success is-fullwidth">
                <?php textPrint('Log in') ?>
              </button>
            </p>
          </div>
        </div>
      </div>

    </form>
  </div>

</section>

<?php routerInclude('layout/footer.php') ?>
