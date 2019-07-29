<?php
function url ($uri) {
  $protocol = 'http' . (stateGet('site.https') and 's') . '://';
  return $protocol . stateGet('site.host') . $uri;
}
