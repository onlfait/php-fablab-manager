<?php
// $_PFM represents the state of the PHP Fablab Manager,
// and this is the only globale defined !
$_PFM = [];

// set a state key/value
function stateSet (string $key, $value) {
  global $_PFM;
  arraySet($_PFM, $key, $value);
}

// push a state key/value
function statePush (string $key, $value) {
  global $_PFM;
  arrayPush($_PFM, $key, $value);
}

// return a state key/value
// or the default value if not set
function stateGet (string $key, $defaultValue = null) {
  global $_PFM;
  return arrayGet($_PFM, $key, $defaultValue);
}

// print a state key/value
// or the default value if not set
function statePrint (string $key, $defaultValue = null) {
  global $_PFM;
  echo(stateGet($key, $defaultValue));
}

// remove a state key/value at first level
function stateRemove (string $key) {
  global $_PFM;
  arrayRemove($_PFM, $key);
}

// merge a state key/value (recursive)
function stateMerge (string $key, array ...$arrays) {
  global $_PFM;
  arrayMerge($_PFM, $key, ...$arrays);
}
