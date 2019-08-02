<?php
function userConnected () {
  return sessionGet('user.connected', false);
}

function userLogout () {
  sessionDestroy();
}

function userLogin ($form) {
  if (userConnected()) {
    routerRedirect('members', 'profil');
  }

  $email = !empty($form['email']) ? filter_var($form['email'], FILTER_SANITIZE_EMAIL) : '';
  $password = !empty($form['password']) ? $form['password'] : '';
  $rememberMe = !empty($form['remember-me']) ? 'checked' : '';
  $errors = [];
  $result = compact('email', 'rememberMe', 'errors');

  if (empty($email) and empty($password)) {
    return $result;
  }

  if ($email !== 'sebastien@onlfait.ch') {
    array_push($result['errors'], text('This user does not exist.'));
  } elseif ($password !== '1234') {
    array_push($result['errors'], text('The password does not match.'));
  }

  if (!count($result['errors'])) {
    sessionSet('user.email', $email);
    sessionSet('user.connected', true);
    routerRedirect('members', 'profil');
  }

  return $result;
}
