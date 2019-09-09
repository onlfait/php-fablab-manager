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
  pfm_print_picto('<img class="responsive" src="public/images/picto/' . $name . '">');
}

function pfm_print_picto_svg($name, $color = null, $bg_color = null) {
  // get SVG contents
  $svg = file_get_contents(PFM_PATH . 'public/images/picto/' . $name);

  // change colors
  if ($color !== null) {
    $svg = str_replace('#fff', $color, $svg);
  }

  if ($bg_color !== null) {
    $svg = str_replace('#000', $bg_color, $svg);
  }
  
  // print SVG contents
  echo '<div class="picto"><div>' . $svg . '</div></div>';
}
