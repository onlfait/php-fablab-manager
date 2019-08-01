<?php
function printNavBarMenu ($menu) {
  foreach ($menu as $label => $item) {
    if (isset($item['page'])) {
      $action = isset($item['action']) ? $item['action'] : null;
      $data = isset($item['data']) ? $item['data'] : [];
      $url = routerURL($item['page'], $action, $data);
      echo('<a class="navbar-item" href="' . $url . '">' . $label . '</a>');
    } else {
      echo('<div class="navbar-item has-dropdown is-hoverable">');
      echo('  <a class="navbar-link">' . $label . '</a>');
      echo('  <div class="navbar-dropdown">');
      printNavBarMenu($item);
      echo('  </div>');
      echo('</div>');
    }
  }
}
