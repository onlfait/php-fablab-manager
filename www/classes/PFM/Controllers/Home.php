<?php namespace PFM\Controllers;

class Home extends \PFM\Controller {
  public function request(array $args = null): void {
    // set layout and view data
    $this->_layout->set('title', $this->_name);
  }
}
