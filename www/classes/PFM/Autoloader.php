<?php
namespace PFM;

abstract class Autoloader {

  protected static $_paths = [];

  public static function addPath(string $path): void {
    if (! in_array($path, self::$_paths)) {
      array_push(self::$_paths, $path);
    }
  }

  public static function loadClass(string $name): bool {
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $name);

    foreach (self::$_paths as $path) {
      $filepath = $path . DIRECTORY_SEPARATOR . $filename . '.php';

      if (is_file($filepath)) {
        require_once $filepath;
        return true;
      }
    }

    return false;
  }

  public static function register(): void {
    spl_autoload_register(array('\PFM\Autoloader', 'loadClass'));
  }
}
