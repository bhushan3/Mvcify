<?php
namespace Mvcify\Controller;

class HomeController extends \Mvcify\Core\Controller
{
    public function index()
    {
        $this->view = new \Mvcify\Core\View();
        $this->view->renderFile($this->getViewFile('index'));
    }

    public function subpage()
    {
        $this->view = new \Mvcify\Core\View();
        $this->view->renderFile($this->getViewFile('subpage'));
    }
}
