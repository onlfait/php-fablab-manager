<?php
/**
 * This file provide some helpers to construct page layouts
 */

 /**
  * HTTP error
  * - send http error code header
  * - include the error page
  * - exit PHP
  * @param [integer] $errorCode
  * @param [string] [$errorMessage = null]
  * @return [void]
  */
 function errorHTTP ($errorCode, $errorMessage = null) {
   // send http header
   http_response_code($errorCode);
   // include page 404
   require(ERRORS_PATH . $errorCode . '.php');
   // exit with 404 status
   exit($errorCode);
 }

 /**
  * Error 404
  * - send 404 header
  * - include the error 404 page
  * - exit PHP
  * @param [string] [$errorMessage = null]
  * @return [void]
  */
 function error404 ($errorMessage = null) {
   errorHTTP(404, $errorMessage);
 }

 /**
  * Error 500
  * - send 500 header
  * - include the error 500 page
  * - exit PHP
  * @param [string] [$errorMessage = null]
  * @return [void]
  */
 function error500 ($errorMessage = null) {
   errorHTTP(500, $errorMessage);
 }

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
