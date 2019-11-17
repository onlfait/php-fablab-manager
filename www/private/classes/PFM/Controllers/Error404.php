<?php
/**
 * This file is part of the PHP Fablab Manager project.
 *
 * @license MIT
 * @author  Sébastien Mischler <sebastien@onlfait.ch>
 */
namespace PFM\Controllers;

use \PFM\HTML as HTML;

/**
 * Error 404 controller.
 */
class Error404 extends \PFM\Controller
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
        // escape html special chars
        $url = HTML::escape($args['route']);

        // set layout and view data
        $this->_layout->set('title', 'Erreur 404');
        $this->_view->set('message', "L'URL demandée {$url} est introuvable sur ce serveur.");
    }
}
