<?php namespace PFM\Controllers;

class Events extends \PFM\Controller
{
    // called when the controller is requested
    public function request(array $args = null): void
    {
        // set layout and view data
        $this->_layout->set('title', $this->_name);
    }
}
