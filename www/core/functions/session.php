<?php
// start a session
function sessionInit () {
  session_start();
}

// set a session key/value
function sessionSet (string $key, $value) {
  arraySet($_SESSION, $key, $value);
}

// return a session key/value
// or the default value if not set
function sessionGet (string $key, $defaultValue = null) {
  return arrayGet($_SESSION, $key, $defaultValue);
}

// print a state key/value
// or the default value if not set
function sessionPrint (string $key, $defaultValue = null) {
  echo(sessionGet($key, $defaultValue));
}
