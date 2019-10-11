<?php namespace PFM\Controllers;

use \PFM\HTML as HTML;

class Error404 extends \PFM\Controller
{
    // called when the controller is requested
    public function request(array $args = null): void
    {
        // escape html special chars
        $url = HTML::escape($args['route']);
        
        // set layout and view data
        $this->_layout->set('title', 'Erreur 404');
        $this->_view->set('message', "L'URL demandée {$url} est introuvable sur ce serveur.");
    }
}
