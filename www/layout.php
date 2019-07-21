<?php
/**
 * This file provide some helpers to construct page layouts
 */

// define absolute path to layout directory
define('LAYOUT_PATH', ROOT_PATH . '/layout/');

/**
 * Print the layout header
 * @return [void]
 */
function printHeader () {
  require(LAYOUT_PATH . 'header.php');
}

/**
 * Print the layout footer
 * @return [void]
 */
function printFooter () {
  require(LAYOUT_PATH . 'footer.php');
}

/**
 * Return the site url
 * @param [string] [$uri = '']
 * @return [void]
 */
function siteURL ($uri = '') {
  return SITE_URL . $uri;
}

/**
 * Print the site url
 * @param [string] [$uri = '']
 * @return [void]
 */
function printURL ($uri) {
  echo(siteURL($uri));
}

/**
 * Print an HTML link
 * @param [string] [$uri = '']
 * @param [string] [$text = null]
 * @return [void]
 */
function printLink ($uri = '', $text = null) {
  // by default $text = $uri
  $text = is_null($text) ? $uri : $text;
  // print the html link
  echo('<a href="' . siteURL($uri) . '">' . $text . '</a>');
}
