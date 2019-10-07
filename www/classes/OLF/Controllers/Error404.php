<?php namespace OLF\Controllers;

class Error404 extends \OLF\Controller {
  public function request(array $args = null): void {
    $url = htmlspecialchars($args['route']);
    $this->data('title', 'Erreur 404');
    $this->data('message', "L'URL demandée {$url} est introuvable sur ce serveur.");
  }
}
