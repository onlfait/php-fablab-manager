<?php
function printNavBarMenu ($menu) {
  foreach ($menu as $key => $value) {
    if (is_int($key) and is_string($value)) {
      echo('<a class="navbar-item" href="' . routerURL($value) . '">' . $value . '</a>');
    }
  }
}
