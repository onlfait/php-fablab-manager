<?php
// get a key/value from array
function arrayGet (array $array, string $key, $defaultValue = null) {
  if (array_key_exists($key, $array)) {
    return $array[$key];
  }
  if (strpos($key, '.') === false) {
    return $defaultValue;
  }
  $target = $array;
  foreach (explode('.', $key) as $segment) {
    if (!is_array($target) or !array_key_exists($segment, $target)) {
      return $defaultValue;
    }
    $target = &$target[$segment];
  }
  return $target;
}

// set a key/value to array
function arraySet (array &$array, string $key, $value, bool $push = false) {
  if (strpos($key, '.') === false) {
    $array[$key] = $value;
  }
  $target = &$array;
  foreach (explode('.', $key) as $segment) {
    if (!isset($target[$segment]) || !is_array($target[$segment])) {
      $target[$segment] = [];
    }
    $target = &$target[$segment];
  }
  if ($push) {
    array_push($target, $value);
  } else {
    $target = $value;
  }
}

// push a key/value to array
function arrayPush (array &$array, string $key, $value) {
  arraySet($array, $key, $value, true);
}

// remove a key/value from array
function arrayRemove (array &$array, string $key) {
  if (strpos($key, '.') === false) {
    unset($array[$key]);
  }
  $target = &$array;
  $segments = explode('.', $key);
  $count = count($segments) - 1;
  foreach ($segments as $i => $segment) {
    if (!is_array($target) or !array_key_exists($segment, $target)) {
      return;
    }
    if ($i < $count) {
      $target = &$target[$segment];
      continue;
    }
    unset($target[$segment]);
  }
}

// array merge (recurcive)
function arrayMerge (array &$array, $key, array ...$arrays) {
  if (!is_array($key)) {
    $value = arrayGet($array, $key);
    if (is_array($value)) {
      arrayMerge($value, ...$arrays);
      arraySet($array, $key, $value);
    }
    return;
  }
  array_unshift($arrays, $key);
  foreach ($arrays as $values) {
    foreach ($values as $key => $value) {
      if (is_integer($key)) {
        array_push($array, $value);
        continue;
      }
      if (isset($array[$key]) && is_array($array[$key]) && is_array($value)) {
        arrayMerge($array[$key], $value);
        continue;
      }
      $array[$key] = $value;
    }
  }
}
