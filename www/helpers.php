<?php
/**
 * Return an item from an array or the default value if not set
 * @param  [array]  $array                 source array
 * @param  [string] $key                   item key
 * @param  [mixed]  [$defaultValue = null] default value to return
 * @return [mixed]
 */
function getArrayItem ($array, $key, $defaultValue = null) {
  if (isset($array[$key]) && !empty($array[$key])) {
    return $array[$key];
  }
  return $defaultValue;
}

/**
 * Replace all accent to ASCII equivalent
 * @param  [string] $string
 * @return [string]
 * @see https://www.php.net/manual/en/function.strtr.php#90925
 */
function replaceAccents ($string) {
  return strtr($string, [
    'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
    'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
    'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
    'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
    'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
    'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
    'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
    'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r'
  ]);
}

/**
 * Return a normalized filename
 * - no accents
 * - lowercase
 * - alphanumerics
 * - [_-] allowed
 * - replace space chars by [-]
 * - remove all non allowed chars
 * @param  [string] $filename
 * @return [string]
 */
function normalizeFilename ($filename) {
  // replace accents
  $filename = replaceAccents($filename);
  // to lowercase
  $filename = strtolower($filename);
  // replace spaces by - char
  $filename = preg_replace('/ +/', '-', $filename);
  // replace all non allowed chars by nothing
  return preg_replace('/[^a-z0-9-_]+/', '', $filename);
}

/**
 * Include the file if it is a file
 * @param  [string] $file
 * @return [boolean]
 */
function includeFile ($file) {
  // test if the file exists and is a file
  if (is_file($file)) {
    // include the file and return true
    include($file);
    return true;
  }
  return false;
}
