<?php
namespace Mvcify\Controller;

class UsersController extends \Mvcify\Core\Controller
{
    public function index()
    {
        $user = new \Mvcify\Model\User();
        $this->view->users = $user->getAllUsers();
        $this->view->renderFile($this->getViewFile('index'));
    }

    public function register()
    {
        if ($this->isPost()) {
            $user = new \Mvcify\Model\User();
            $result = $user->createUser(
                $this->getParameter('name'),
                $this->getParameter('location'),
                $this->getParameter('email')
            );

            if (false !== $result) {
                $response = array(
                    'success' => true,
                    'data'    => $user->getUser($result)
                );
                $this->view->sendJson($response);
            } else {
                $this->view->sendJson(array( 'success' => false ));
            }
        } else {
            $page = new \Mvcify\Controller\ErrorController();
            $page->index();
        }
    }

    public function editUser($id)
    {
        $id    = intval($id);
        $user  = new \Mvcify\Model\User();
        $_user = $user->getUser($id);

        if (false === $_user) {
            $page = new \Mvcify\Controller\ErrorController();
            $page->index();
        } else {
            if ($this->isPost()) {
                $result = $user->updateUser(
                    $this->getParameter('name'),
                    $this->getParameter('location'),
                    $this->getParameter('email'),
                    $id
                );

                if ($result) {
                    $responce = array(
                        'success' => true,
                        'redirect' => SITE_URL . '/users'
                    );
                    $this->view->sendJson($responce);
                } else {
                    $this->view->sendJson(array( 'success' => false ));
                }
            } else {
                $this->view->user = $_user;
                $this->view->renderFile($this->getViewFile('edit'));
            }
        }
    }

    public function deleteUser($id)
    {
        $id   = intval($id);
        $user = new \Mvcify\Model\User();
        $user->deleteUser($id);
        header('Location: ' . SITE_URL . '/users');
    }
}
