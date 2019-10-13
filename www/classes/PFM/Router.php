<?php
/**
 * This file is part of the PHP Fablab Manager project.
 *
 * @license MIT
 * @author  Sébastien Mischler <sebastien@onlfait.ch>
 */
namespace PFM;

/**
 * Simple URL router.
 *
 * @example ../doc/examples/Router.php 6 Basic usage.
 */
abstract class Router
{
    /**
     * Regexp tokens.
     *
     * @var array
     */
    protected static $_tokens = [];

    /**
     * Routes collection.
     *
     * @var array
     */
    protected static $_routes = [];

    /**
     * Current route.
     *
     * @var array
     */
    protected static $_route = null;

    /**
     * Not found callback.
     *
     * @var \Callable
     */
    protected static $_notFoundCallback = null;

    /**
     * Return the current URI.
     *
     * @return string
     */
    public static function uri(): string
    {
        return isset($_GET['uri']) ? $_GET['uri'] : '/';
    }

    /**
     * Set a new regexp token.
     *
     * @param string $name
     * @param string $pattern
     */
    public static function setToken(string $name, string $pattern): void
    {
        self::$_tokens[$name] = $pattern;
    }

    /**
     * Parse the route and return a compiled Regexp.
     *
     * @param string $route
     *
     * @return string
     */
    protected static function _parseRoute(string $route): string
    {
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

    /**
     * Add a new route.
     *
     * @param string    $route
     * @param \Callable $callback
     */
    public static function addRoute(string $route, $callback): void
    {
        $regexp = !!strpos($route, '<');
        $regexp = $regexp ? self::_parseRoute($route) : false;

        array_push(self::$_routes, [
            'route'    => $route,
            'regexp'   => $regexp,
            'callback' => $callback
        ]);
    }

    /**
     * Set the not found callback.
     *
     * @param \Callable $callback
     */
    public static function notFound($callback): void
    {
        self::$_notFoundCallback = $callback;
    }

    /**
     * Dispatch the request.
     *
     * @param array      $route
     * @param null|array $args
     *
     * @return bool
     */
    protected static function _dispatch(array $route, array $args = null): bool
    {
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

    /**
     * Dispatch the request.
     *
     * @param array $route
     *
     * @return bool
     */
    public static function dispatch(string $route): bool
    {
        foreach (self::$_routes as $_route) {
            if ($_route['regexp']) {
                if (preg_match($_route['regexp'], $route, $matches)) {
                    $args = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    return self::_dispatch($_route, $args);
                }
            } elseif ($route === $_route['route']) {
                return self::_dispatch($_route);
            }
        }

        http_response_code(404);

        if (self::$_notFoundCallback) {
            $route2 = [ 'route' => $route, 'callback' => self::$_notFoundCallback ];

            if (self::_dispatch($route2, [ 'route' => $route ])) {
                return true;
            }
        }

        echo 'Error 404 - Page Not Found';

        return false;
    }
}
