<?php
/**
 * This file is part of the PHP Fablab Manager project.
 *
 * @license MIT
 * @author  Sébastien Mischler <sebastien@onlfait.ch>
 */
namespace PFM;

/**
 * Abstract controller class. Must be derived by all controllers.
 */
abstract class Controller
{
    /**
     * Controller name without the namespace.
     *
     * @var string
     */
    protected $_name = 'Controller';

    /**
     * Layout view path.
     *
     * @var string
     */
    protected $_layout = 'layouts/index.php';

    /**
     * Layout contents view path.
     *
     * @var string|null
     */
    protected $_view = null;

    /**
     * Constructor.
     *
     * Initialize controller defaults properties.
     */
    public function __construct()
    {
        $this->_name = \str_replace('PFM\\Controllers\\', '', \get_class($this));

        if ($this->_view === null) {
            $this->_view = 'pages/' . \strtolower($this->_name) . '.php';
        }

        $this->_view = new View($this->_view);
        $this->_layout = new View($this->_layout);

        $this->_layout->set('contents', $this->_view);
    }

    /**
     * Request handler.
     *
     * This method is called when a route is resolved.
     *
     * You must implement this method in all controllers.
     * This is where you handle the request.
     *
     * @param null|array $args - Route arguments.
     */
    abstract public function request(array $args = null): void;

    /**
     * Call the request handler and render the layout.
     *
     * YOU SHOULD NOT CALL THIS METHOD DIRECTLY.
     *
     * This method is called by the {@see \PFM\Router::dispatch()} when a route is resolved.
     *
     * @param null|array $args Route arguments.
     */
    public function dispatch(array $args = null): void
    {
        $this->request($args);
        $this->_layout->display();
    }
}
