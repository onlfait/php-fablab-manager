<?php
// start a session
function sessionStart () {
  session_start();
  session_regenerate_id(true);
}

// stop a session
function sessionDestroy () {
  extract(session_get_cookie_params());
  cookieRemove(session_name(), $path, $domain, $secure, $httponly);
  $_SESSION = array();
  session_destroy();
}

// set a session key/value
function sessionSet (string $key, $value) {
  arraySet($_SESSION, $key, $value);
}

// push a session key/value
function sessionPush (string $key, $value) {
  arrayPush($_SESSION, $key, $value);
}

// return a session key/value
// or the default value if not set
function sessionGet (string $key, $defaultValue = null) {
  return arrayGet($_SESSION, $key, $defaultValue);
}

// print a session key/value
// or the default value if not set
function sessionPrint (string $key, $defaultValue = null) {
  echo(sessionGet($key, $defaultValue));
}

// remove a session key/value at first level
function sessionRemove (string $key) {
  arrayRemove($_SESSION, $key);
}

// merge a session key/value (recursive)
function sessionMerge (string $key, array ...$arrays) {
  arrayMerge($_SESSION, $key, ...$arrays);
}
