<?php namespace PFM;

abstract class Controller {
  protected $_name   = 'Controller';
  protected $_layout = 'layouts/index.php';
  protected $_view   = null;
  protected $_data   = [];

  public function __construct() {
    $this->_name = str_replace('PFM\\Controllers\\', '', get_class($this));
    if ($this->_view === null) {
      $this->_view = 'pages/' . strtolower($this->_name) . '.php';
    }
  }

  public function data(string $key, $value = null) {
    if (func_num_args() === 1) {
      return $this->_data[$key];
    }
    $this->_data[$key] = $value;
  }

  public function request(array $args = null): void {
    $this->_data = ['title' => $this->_name];
  }

  public function dispatch(array $args = null): void {
    // process request data
    $this->request($args);
    // render contents
    $view = new \PFM\View($this->_view);
    $this->_data['contents'] = $view->render($this->_data);
    // render layout
    $layout = new \PFM\View($this->_layout);
    echo $layout->render($this->_data);
  }
}
