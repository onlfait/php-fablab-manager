<?php namespace PFM;

abstract class Router {
  protected static $_tokens = [];
  protected static $_routes = [];
  protected static $_route = null;
  protected static $_notFoundCallback = null;

  public static function uri(): string {
    return isset($_GET['uri']) ? $_GET['uri'] : '/';
  }

  public static function setToken(string $name, string $pattern): void {
    self::$_tokens[$name] = $pattern;
  }

  protected static function _parseRoute(string $route): string {
    $parts = explode('/', $route);
    foreach ($parts as $key => $part) {
      if (strpos($part, ':') !== false) {
        $parts[$key] = preg_replace('/\<([^:]+):([^\>]+)\>/', '(?<$1>$2)', $part);
      } else {
        $tokens = self::$_tokens;
        $parts[$key] = preg_replace_callback('/\<([^\>]+)\>/', function ($matches) use ($tokens) {
          $subpattern = isset($tokens[$matches[1]]) ? $tokens[$matches[1]] : '[^\\/]+';
          return "(?<{$matches[1]}>{$subpattern})";
        }, $part);
      }
    }
    $pattern = implode('\\/', $parts);
    return "/^{$pattern}$/";
  }

  public static function addRoute(string $route, $callback): void {
    $regexp = !!strpos($route, '<');
    $regexp = $regexp ? self::_parseRoute($route) : false;
    array_push(self::$_routes, [
      'route'    => $route,
      'regexp'   => $regexp,
      'callback' => $callback
    ]);
  }

  public static function notFound($callback): void {
    self::$_notFoundCallback = $callback;
  }

  protected static function _dispatch(array $route, array $args = null): bool {
    self::$_route = $route;
    $callback = $route['callback'];
    if (is_callable($callback)) {
      $route['callback']($args, $route);
      return true;
    }
    if (class_exists($callback)) {
      $instance = new $callback();
      $instance->dispatch($args, $route);
      return true;
    }
    http_response_code(500);
    throw new \Exception("Undefined callback [{$callback}]");
  }

  public static function dispatch(string $route): bool {
    foreach (self::$_routes as $_route) {
      if ($_route['regexp']) {
        if (preg_match($_route['regexp'], $route, $matches)) {
          $args = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
          return self::_dispatch($_route, $args);
        }
      } else if ($route === $_route['route']) {
        return self::_dispatch($_route);
      }
    }
    http_response_code(404);
    if (self::$_notFoundCallback) {
      $result = self::_dispatch([
        'route'    => $route,
        'callback' => self::$_notFoundCallback
      ], [ 'route' => $route ]);
      if ($result) {
        return true;
      }
      echo 'Error 404 - Page Not Found';
    }
    return false;
  }
}
