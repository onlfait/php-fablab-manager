<?php
/**
 * This file is the single entry point of the application.
 *
 * This file is responsible to :
 *  - Define the main namespace.
 *  - Define some common constants.
 *  - Require and call the startup function.
 */
namespace PFM;

/**
 * Directory separator
 *
 * @var string Pouet tralala...
 */
const DS = DIRECTORY_SEPARATOR;

/** Absolute path to root directory */
define('PFM\ROOT_PATH', dirname(__FILE__) . DS);

/** Absolute path to core directory */
define('PFM\CORE_PATH', ROOT_PATH . 'core' . DS);

/** Absolute path to main directory */
define('PFM\MAIN_PATH', ROOT_PATH . 'main' . DS);

// Require core startup functions
require_once(CORE_PATH . 'functions' . DS . 'startup.php');

// Startup PHP Fablab Manager
\PFM\core\functions\startup();
