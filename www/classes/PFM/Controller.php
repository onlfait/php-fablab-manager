<?php namespace PFM;

abstract class Controller {
  protected $_name   = 'Controller';
  protected $_layout = 'layouts/index.php';
  protected $_view   = null;

  public function __construct() {
    $this->_name = str_replace('PFM\\Controllers\\', '', get_class($this));
    $this->_layout = new \PFM\View($this->_layout);
    if ($this->_view === null) {
      $this->_view = 'pages/' . strtolower($this->_name) . '.php';
    }
    $this->_view = new \PFM\View($this->_view);
    $this->_layout->set('contents', $this->_view);
  }

  abstract public function request(array $args = null): void;

  public function dispatch(array $args = null): void {
    $this->request($args);
    $this->_layout->display();
  }
}
