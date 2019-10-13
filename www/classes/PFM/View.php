<?php
/**
 * This file is part of the PHP Fablab Manager project.
 *
 * @license MIT
 * @author  Sébastien Mischler <sebastien@onlfait.ch>
 */
namespace PFM;

/**
 * Simple PHP View renderer.
 *
 * @example ../doc/examples/View.php 6 12 Basic usage.
 * @example ../doc/examples/View.php 21 Nested views.
 */
class View
{
    /**
     * Collection of paths without a trailing slash.
     *
     * @var array
     */
    protected static $_paths = [];

    /**
     * Add a path to a views directory.
     *
     * @param string $path
     */
    public static function addPath(string $path): void
    {
        if (! in_array($path, self::$_paths)) {
            array_push(self::$_paths, $path);
        }
    }

    /**
     * Parent view.
     *
     * @var null|View
     */
    protected $_parent = null;

    /**
     * Relative file path.
     *
     * @var string
     */
    protected $_file = null;

    /**
     * View data.
     *
     * @var array
     */
    protected $_data = [];

    /**
     * Constructor.
     *
     * Initialize view defaults properties.
     *
     * @param string $file Relative path to view.
     */
    public function __construct(string $file)
    {
        $this->_file = $file;
    }

    /**
     * Set parent view.
     *
     * YOU SHOULD NOT CALL THIS METHOD DIRECTLY.
     *
     * @param View $view
     */
    public function setParent(View $view): void
    {
        $this->_parent = $view;
    }

    /**
     * Return view data with parent data merged.
     *
     * @return array
     */
    public function data(): array
    {
        $data = $this->_data;

        if ($this->_parent) {
            $data = array_merge($this->_parent->data(), $data);
        }

        return $data;
    }

    /**
     * Get data value by key.
     *
     * @param string $key
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    public function get(string $key, $defaultValue = null)
    {
        $data = $this->data();

        return isset($data[$key]) ? $data[$key] : $defaultValue;
    }

    /**
     * Set data by key/value pair or array of key/value pair.
     *
     * @param string|array $key
     * @param mixed        $value
     */
    public function set($key, $value = null): void
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->set($k, $v);
            }
            return;
        }

        if ($value instanceof View) {
            $value->setParent($this);
        }

        $this->_data[$key] = $value;
    }

    /**
     * Get data value by key.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Set data by key/value.
     *
     * @param string|array $key
     * @param mixed        $value
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Scoped renderer.
     *
     * @return string
     */
    protected function _render(): string
    {
        ob_start();
        extract($this->data());
        require func_get_arg(0);
        return ob_get_clean();
    }

    /**
     * Return the rendered view.
     *
     * @return string
     */
    public function render(): string
    {
        foreach (self::$_paths as $path) {
            $filepath = $path . DIRECTORY_SEPARATOR . $this->_file;

            if (is_file($filepath)) {
                return $this->_render($filepath);
            }
        }
        
        return "ERROR: view [{$this->_file}] not found...";
    }

    /**
     * Display the rendered view.
     *
     * @return string
     */
    public function display(): void
    {
        echo $this->render();
    }

    /**
     * Return the rendered view.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }
}
