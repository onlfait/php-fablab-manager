<?php
// print a menu
function pfm_print_menu($items, $class = 'menu-item') {
  global $PFM;

  foreach ($items as $key => $value) {
    // If the value is a string, link to route name
    if (is_string($value)) {
      // add selected class
      $_class = $class;
      if ($value === $PFM['route']['uri']) {
        $_class .= ' selected';
      }
      $url = pfm_router_url($value);
      $title = $PFM['routes'][$value]['title'];
      printf('<a class="%s" href="%s">%s</a>', $_class, $url, $title);
    }
  }
}

// print a CSS picto
function pfm_print_picto($title, $subtitle = null, $rotate = false) {
  echo '<div class="picto">';
  echo '<div' . ($rotate ? ' class="rotate"' : '') . '>';
  echo '<span>' . $title . '</span>';
  if (! empty($subtitle)) {
    echo '<span>' . $subtitle . '</span>';
  }
  echo '</div></div>';
}

function pfm_print_picto_img($name) {
  pfm_print_picto('<img class="responsive" src="Image/Picto/' . $name .'.png">');
}
