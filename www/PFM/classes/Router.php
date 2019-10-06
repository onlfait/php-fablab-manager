<?php
namespace PFM;

class Router {
  public static $_routes = [];

  public static function addRoute(string $pattern): void {
    var_dump(['addRoute', $pattern]);
  }

  public static function dispatch(string $route, \Closure $callback): void {
    var_dump(['dispatch', $route, $callback]);
    call_user_func($callback);
  }
}
