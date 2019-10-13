<?php
/**
 * This file is part of the PHP Fablab Manager project.
 *
 * @license MIT
 * @author  Sébastien Mischler <sebastien@onlfait.ch>
 */
namespace PFM;

/**
 * The Autoloader is used to auto load undefined class/interface.
 *
 * @see https://www.php.net/manual/en/function.autoload.php
 */
abstract class Autoloader
{
    /**
     * Collection of paths without a trailing slash.
     *
     * @var string[]
     */
    protected static $_paths = [];

    /**
     * Registered flag.
     *
     * @var bool
     */
    protected static $_registered = false;

    /**
     * Normalize a path.
     *
     * - Normalize directory separator
     * - Remove trailing slash
     *
     * @param string $path
     *
     * @return string
     */
    public static function normalizePath(string $path): string
    {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
        $path = rtrim($path, DIRECTORY_SEPARATOR);

        return $path;
    }

    /**
     * Add a path to a class directory.
     *
     * @param string $path
     */
    public static function addPath(string $path): void
    {
        $path = self::normalizePath($path);

        if (! in_array($path, self::$_paths)) {
            array_push(self::$_paths, $path);
        }
    }

    /**
     * Try to load a class file from the class name.
     *
     * @param string $name
     *
     * @return bool
     */
    public static function loadClass(string $name): bool
    {
        $name = self::normalizePath($name);

        foreach (self::$_paths as $path) {
            $filepath = $path . DIRECTORY_SEPARATOR . $name . '.php';

            if (is_file($filepath)) {
                require_once $filepath;
                return true;
            }
        }

        return false;
    }

    /**
     * Register the autoloader.
     */
    public static function register(): void
    {
        if (self::$_registered) {
            return;
        }

        spl_autoload_register(array('\PFM\Autoloader', 'loadClass'));

        self::$_registered = true;
    }
}
