<?php
// set a cookie name/value
function cookieSet (string $name, string $value = '', ...$options)  {
  return setcookie($name, $value, ...$options);
}

// return a cookie
// or the default value if not set
function cookieGet (string $name, $defaultValue = null) {
  return arrayGet($_COOKIE, $name, $defaultValue);
}

// remove a cookie
function cookieRemove (string $name, ...$options) {
  if (isset($_COOKIE[$name])) {
    return setcookie($name, '', time() - 3600, ...$options);
  }
  return false;
}
