<?php
/**
 * This file provide some database helpers
 */

/**
 * Open a new connection to the MySQL server,
 * or return the opened connection.
 * @return [object] MySQL connection
 */
function dbConnect () {
  // set $dbLink static
  // (https://www.php.net/manual/fr/language.variables.scope.php)
  static $dbLink = null;

  // if database link is already open
  if ($dbLink) {
    // just return the database link
    return $dbLink;
  }

  // try to connect to the database
  $dbLink = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  // if somthing goes wrong
  if ($dbLink->connect_errno) {
    error500();
  }

  // return the database link
  return $dbLink;
}

/**
 * Execute a SELECT query and return the result
 * @param  [string] $what
 * @param  [string] $from
 * @param  [string] $option
 * @return [mysqli_result]
 */
function dbSelect ($what, $from, $option = '') {
  $dbLink = dbConnect();
  return $dbLink->query('SELECT ' . $what . ' FROM ' . $from . ' ' . $option);
}

/**
 * Execute a SELECT query and return the result as array
 * @param  [string] $what
 * @param  [string] $from
 * @param  [string] $option
 * @return [array]
 */
function dbSelectArray ($what, $from, $option = '') {
  $results = [];
  $result = dbSelect($what, $from, $option = '');
  while ($row = $result->fetch_assoc()) {
    array_push($results, $row);
  }
  $result->free();
  return $results;
}
