<?php declare(strict_types=1);
/**
 * This file provide some normalization functions.
 */
namespace PFM\core\functions;

// uses
use const \PFM\DS;

/**
 * Return the path with all separator normalized.
 *
 * @param  string $path Path to normalize
 * @return string       Normalized path
 */
function normalize_directory_separator (string $path) {
  return preg_replace('/[\\/]/', DS, $path);
}
