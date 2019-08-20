<?php declare(strict_types=1);
/**
 * This file provide some importation functions.
 */
namespace PFM\core\functions;

// uses
use const \PFM\ROOT_PATH;
use const \PFM\CORE_PATH;
use const \PFM\MAIN_PATH;
use const \PFM\DS;

// Require normalization functions
require_once(ROOT_PATH . 'core' . DS . 'functions' . DS . 'normalize.php');

/** Default import extension */
const IMPORT_EXT = '.php';

/**
 * Import a (PHP) file from provided path.
 *
 * @param  string $path Base path
 * @param  string $file Base name
 * @param  string $ext  Extension
 * @return void
 */
function import (string $path, string $file, string $ext = IMPORT_EXT) {
  require_once(normalize_directory_separator($path . $file . $ext));
}

/**
 * Import a (PHP) file from "\PFM\ROOT_PATH".
 *
 * @param  string $file Base name
 * @param  string $ext  Extension
 * @return void
 */
function import_root (string $file, string $ext = IMPORT_EXT) {
  import(ROOT_PATH, $file, $ext);
}

/**
 * Import a (PHP) file from "\PFM\CORE_PATH".
 *
 * @param  string $file Base name
 * @param  string $ext  Extension
 * @return void
 */
function import_core (string $file, string $ext = IMPORT_EXT) {
  import(CORE_PATH, $file, $ext);
}

/**
 * Import a (PHP) file from "\PFM\MAIN_PATH".
 *
 * @param  string $file Base name
 * @param  string $ext  Extension
 * @return void
 */
function import_main (string $file, string $ext = IMPORT_EXT) {
  import(MAIN_PATH, $file, $ext);
}
