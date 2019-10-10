<?php

namespace Mvcify\Core;

class Controller
{
    /**
     * Holds the name of the current controller.
     *
     * @var object
     */
    public $name = '';

    /**
     * Holds the instance of a view class.
     *
     * @var object
     */
    public $view;

    /**
     * Holds the instance of request objetc.
     *
     * @var object
     */
    protected $request;

    /**
     * Setup and initialize required data
     */
    public function __construct()
    {
        // Create a instance of a view.
        $this->view = new \Mvcify\Core\View();

        // Set the current controller name.
        $name = get_class($this);
        $name = explode('\\', $name);
        $name = array_pop($name);
        $name = str_replace('Controller', '', $name);
        $this->name = $name;
    }

    /**
     * Returns the view file for the given action.
     *
     * @param string $action
     * @return string the path to the view file
     */
    public function getViewFile($action)
    {
        return APP_PATH . '/View/' . $this->name . '/' . $action . '.php';
    }

    public function isPost()
    {
        return 'POST' === $_SERVER['REQUEST_METHOD'];
    }

    public function isGet()
    {
        return 'GET' === $_SERVER['REQUEST_METHOD'];
    }

    public function getParameter($name, $default = null)
    {
        if ($this->isPost()) {
            if (isset($_POST[$name])) {
                return $_POST[$name];
            }
        } elseif ($this->isGet()) {
            if (isset($_GET[$name])) {
                return $_GET[$name];
            }
        }
        return $default;
    }

    public function getAllParameters()
    {
        if ($this->isPost()) {
            return $_POST;
        } elseif ($this->isGet()) {
            return $_GET;
        }
    }
}
