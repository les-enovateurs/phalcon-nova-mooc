<?php

use NovaMooc\Forms\RegisterForm;
use NovaMooc\Forms\ConnectionForm;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->tag->appendTitle(' - Login');

        $oConnectionForm = null;

        if (true === $this->request->isPost()) {
            $oConnectionForm = new ConnectionForm();

            if (true === $oConnectionForm->isValid($this->request->getPost())) {
                $oContent = $this->api->post('login', $this->request->getPost());

                if ($oContent instanceof \NovaMooc\Library\AppError) {
                    $this->view->errors = $oContent->getMessage();
                } else {
                    $this->session->set('user', $oContent->user);
                    $this->session->set('token', $oContent->token);

                    $this->response->redirect('teacher');
                    return $this->response->send();
                }
            } else {
                $aMessages = $oConnectionForm->getMessages();
                $sErrors  = '';

                foreach ($aMessages as $sMessage) {
                    $sErrors .= '- ' . $sMessage . '<br />';
                }

                $this->view->errors = $sErrors;
            }
        } else {
            $oConnectionForm = new ConnectionForm(null);
        }

        $this->view->connection_form = $oConnectionForm;
    }

    public function registerAction()
    {
        $this->tag->appendTitle(' - Register');

        $oRegisterForm = null;

        if (true === $this->request->isPost()) {
            $oRegisterForm = new RegisterForm();

            if (true === $oRegisterForm->isValid($this->request->getPost())) {
                $oContent = $this->api->post('register', $this->request->getPost());
                if ($oContent instanceof \NovaMooc\Library\AppError) {
                    $this->view->errors = $oContent->getMessage();
                } else {
                    $this->session->set('user', $oContent->user);
                    $this->session->set('token', $oContent->token);

                    $this->logger->error(json_encode([
                        'token' => $oContent->token
                    ]));

                    $this->response->redirect('teacher');
                    return $this->response->send();
                }
            } else {
                $aMessages = $oRegisterForm->getMessages();
                $sErrors  = '';

                foreach ($aMessages as $sMessage) {
                    $sErrors .= '- ' . $sMessage . '<br />';
                }

                $this->view->errors = $sErrors;
            }
        } else {
            $oRegisterForm = new RegisterForm(null);
        }

        $this->view->register_form = $oRegisterForm;
    }

    public function logoutAction()
    {
        $this->session->destroy();

        $this->response->redirect('/');
    }

    public function healthAction()
    {
        $oContent = $this->api->get('health');

        if ($oContent instanceof \NovaMooc\Library\AppError) {
            $this->view->errors = $oContent->getMessage();
        } else {
            $this->view->message = $oContent->state;
        }
    }
}

