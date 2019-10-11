<?php namespace PFM;

class View
{
    protected $_parent = null;
    protected $_file = null;
    protected $_data = [];

    protected static $_paths = [];

    public static function addPath(string $path): void
    {
        if (! in_array($path, self::$_paths)) {
            array_push(self::$_paths, $path);
        }
    }

    public function __construct(string $file)
    {
        $this->_file = $file;
    }

    public function setParent(View $view): void
    {
        $this->_parent = $view;
    }

    public function set($key, $value = null)
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

    public function data()
    {
        $data = $this->_data;
        if ($this->_parent) {
            $data = array_merge($this->_parent->data(), $data);
        }
        return $data;
    }

    public function get($key)
    {
        $data = $this->data();
        return $data[$key];
    }

    public function __get($key)
    {
        return $this->get($name);
    }

    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    protected function _render(): string
    {
        ob_start();
        extract($this->data());
        require func_get_arg(0);
        return ob_get_clean();
    }

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

    public function display(): void
    {
        echo $this->render();
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
