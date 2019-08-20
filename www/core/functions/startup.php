<?php declare(strict_types=1);
/**
 * This file provide the startup function.
 */
namespace PFM\core\functions;

// uses
use const \PFM\ROOT_PATH;
use const \PFM\DS;

// Require importation functions
require_once(ROOT_PATH . 'core' . DS . 'functions' . DS . 'import.php');

/**
 * Startup PHP Fablab Manager
 *
 * This is a Singleton function,
 * calling this function several times will have no effect.
 *
 * @return bool true on success, false otherwise
 */
function startup () {
  // Singleton function
  static $called = false;

  // If already called
  if ($called === true) {
    return false;
  }

  // Set called flag to true
  $called = true;

  // Imports core commons
  import_core('classes/collection');

  // Started :)
  return true;
}
