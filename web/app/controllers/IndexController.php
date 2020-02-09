<?php

use NovaMooc\Forms\InscriptionForm;
use NovaMooc\Forms\ConnexionForm;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->tag->appendTitle(' - Connexion');

        $oConnexionForm = null;

        if (true === $this->request->isPost()) {
            $oConnexionForm = new ConnexionForm();

            if (true === $oConnexionForm->isValid($this->request->getPost())) {
                $oContenu = $this->api->post('connexion', $this->request->getPost());

                if ($oContenu instanceof \NovaMooc\Library\ApplicationErreur) {
                    $this->view->erreurs = $oContenu->getMessage();
                } else {
                    $this->session->set('utilisateur', $oContenu->utilisateur);
                    $this->session->set('token', $oContenu->token);

                    $this->logger->error(json_encode([
                        'token' => $oContenu->token
                    ]));

                    $this->response->redirect('enseignant');
                    return $this->response->send();
                }
            } else {
                $aMessages = $oConnexionForm->getMessages();
                $sErreurs  = '';

                foreach ($aMessages as $sMessage) {
                    $sErreurs .= '- ' . $sMessage . '<br />';
                }

                $this->view->erreurs = $sErreurs;
            }
        } else {
            $oConnexionForm = new ConnexionForm(null);
        }

        $this->view->connexion_form = $oConnexionForm;
    }

    public function inscriptionAction()
    {
        $this->tag->appendTitle(' - Inscription');

        $oInscriptionForm = null;

        if (true === $this->request->isPost()) {
            $oInscriptionForm = new InscriptionForm();

            if (true === $oInscriptionForm->isValid($this->request->getPost())) {
                $oContenu = $this->api->post('inscription', $this->request->getPost());
                if ($oContenu instanceof \NovaMooc\Library\ApplicationErreur) {
                    $this->view->erreurs = $oContenu->getMessage();
                } else {
                    $this->session->set('utilisateur', $oContenu->utilisateur);
                    $this->session->set('token', $oContenu->token);

                    $this->logger->error(json_encode([
                        'token' => $oContenu->token
                    ]));

                    $this->response->redirect('enseignant');
                    return $this->response->send();
                }
            } else {
                $aMessages = $oInscriptionForm->getMessages();
                $sErreurs  = '';

                foreach ($aMessages as $sMessage) {
                    $sErreurs .= '- ' . $sMessage . '<br />';
                }

                $this->view->erreurs = $sErreurs;
            }
        } else {
            $oInscriptionForm = new InscriptionForm(null);
        }

        $this->view->inscription_form = $oInscriptionForm;
    }

    public function deconnexionAction()
    {
        $this->session->destroy();

        $this->response->redirect('/');
    }

    public function santeAction()
    {
        $oContenu = $this->api->get('sante');

        if ($oContenu instanceof \NovaMooc\Library\ApplicationErreur) {
            $this->view->erreurs = $oContenu->getMessage();
        } else {
            $this->view->message = $oContenu->etat;
        }
    }
}

