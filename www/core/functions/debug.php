<?php
// print variable contents
function debugVar (...$vars) {
  foreach ($vars as $var) {
    echo '<pre>' . print_r($var, true) . '</pre>';
  }
}
