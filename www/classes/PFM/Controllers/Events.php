<?php
/**
 * This file is part of the PHP Fablab Manager project.
 *
 * @license MIT
 * @author  Sébastien Mischler <sebastien@onlfait.ch>
 */
namespace PFM\Controllers;

/**
 * Events controller.
 */
class Events extends \PFM\Controller
{
    /**
     * Request handler.
     *
     * This is where you handle the request.
     *
     * @param null|array $args - Route arguments.
     */
    public function request(array $args = null): void
    {
        // set layout and view data
        $this->_layout->set('title', $this->_name);
    }
}
