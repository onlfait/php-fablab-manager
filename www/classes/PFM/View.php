<?php namespace PFM;

class View {
  protected $_file = null;

  protected static $_paths = [];

  public static function addPath(string $path): void {
    if (! in_array($path, self::$_paths)) {
      array_push(self::$_paths, $path);
    }
  }

  public function __construct(string $file) {
    $this->_file = $file;
  }

  public function _render(string $file, array $data = null): string {
    ob_start();
    $data && extract($data);
    require func_get_arg(0);
    return ob_get_clean();
  }

  public function render(array $data = null): string {
    foreach (self::$_paths as $path) {
      $filepath = $path . DIRECTORY_SEPARATOR . $this->_file;
      if (is_file($filepath)) {
        return $this->_render($filepath, $data);
      }
    }
    return "ERROR: view [{$this->_file}] not found...";
  }
}
