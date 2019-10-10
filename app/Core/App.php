<?php
namespace Mvcify\Core;

class App
{
    /**
     * Stores the controller name or instance of the controller.
     *
     * @var string|object
     */
    private $controller = 'Home';

    /**
     * Stores the name of the controller method, often also called as 'action'.
     *
     * @var string
     */
    private $action = 'index';

    /**
     * Stores the request parameters.
     * @var array
     */
    private $parameters = array();

    /**
     * Initialize the app.
     */
    public function __construct()
    {
        // Load the global functions.
        require 'Functions.php';

        // Parse the request URL.
        $this->parseRequest();

        // Form fully qualified name for the controller.
        $controller = '\Mvcify\Controller\\' . $this->controller . 'Controller';

        // Check if controller and action exists or else use error controller.
        if (class_exists($controller) && method_exists($controller, $this->action) && is_callable(array($controller, $this->action))) {
            $this->controller = new $controller();
            if (!empty($this->parameters)) {
                call_user_func_array(array($this->controller, $this->action), $this->parameters);
            } else {
                $this->controller->{$this->action}();
            }
        } else {
            $this->controller = new \Mvcify\Controller\ErrorController();
            $this->controller->index();
        }
    }

    /**
     * Parse the request.
     */
    private function parseRequest()
    {
        $url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $url = preg_replace('/^' . preg_quote('/' . SITE_SUB_FOLDER . '/', '/') . '/', '', $url);
        $url = trim($url, '/');
        $url = parse_url($url);

        $path = isset($url['path']) ? explode('/', $url['path']) : array();

        $this->controller = isset($path[0]) && !empty($path[0]) ? preg_replace('/\W+/', '', ucfirst(strtolower($path[0]))) : $this->controller;
        $this->action     = isset($path[1]) && !empty($path[1]) ? preg_replace('/\W+/', '', strtolower($path[1])) : $this->action;
        $this->parameters = array_values(array_slice($path, 2));

        // For debugging. uncomment this if you have problems with the URL
        // echo '<pre>Controller: ' . $this->controller . '</pre>';
        // echo '<pre>Action: ' . $this->action . '</pre>';
        // echo '<pre>Parameters: ' . print_r($this->parameters, true) . '</pre>';
    }
}
