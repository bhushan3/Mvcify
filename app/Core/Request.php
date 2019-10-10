<?php
namespace Mvcify\Core;

class Request
{
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
