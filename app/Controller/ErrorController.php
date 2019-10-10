<?php
namespace Mvcify\Controller;

class ErrorController extends \Mvcify\Core\Controller
{
    public function index()
    {
        $this->view = new \Mvcify\Core\View();
        $this->view->renderFile($this->getViewFile('index'));
    }
}
