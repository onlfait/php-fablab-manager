<?php
/**
 * This file provide some database helpers
 */

// Open a new connection to the MySQL server
$dbConnection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if somthing goes wrong, print error 500
if ($dbConnection->connect_errno) {
  error500();
}

/**
 * Execute a SELECT query and return the result
 * @param  [string] $what
 * @param  [string] $from
 * @param  [string] $option
 * @return [mysqli_result]
 */
function dbSelect ($what, $from, $option = '') {
  global $dbConnection;
  return $dbConnection->query(
    'SELECT ' . $what . ' FROM ' . DB_PREFIX . $from . ' ' . $option
  );
}

/**
 * Execute a SELECT query and return the result as array
 * @param  [string] $what
 * @param  [string] $from
 * @param  [string] $option
 * @return [array]
 */
function dbSelectArray ($what, $from, $option = '') {
  // set empty results array
  $results = [];
  // query the database
  $result = dbSelect($what, $from, $option = '');
  // if no results, return empty array
  if (!$result) {
    return $results;
  }
  // fetch all result row
  while ($row = $result->fetch_assoc()) {
    array_push($results, $row);
  }
  // free MySQL result
  $result->free();
  // return results array
  return $results;
}
