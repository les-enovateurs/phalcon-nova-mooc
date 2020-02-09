<?php

use NovaMooc\Forms\CoursForm;

class CoursController extends ControllerBase
{
    public function nouveauAction()
    {
        $this->tag->appendTitle(' - Nouveau cours');

        $oCoursForm = null;

        if (true === $this->request->isPost()) {
            $oCoursForm = new CoursForm();

            if (true === $oCoursForm->isValid($this->request->getPost())) {
                $oContenu = $this->api->post('cours/nouveau', $this->request->getPost());
                if ($oContenu instanceof \NovaMooc\Library\ApplicationErreur) {
                    $this->view->erreurs = $oContenu->getMessage();
                } else {

                    $this->response->redirect('enseignant');
                    return $this->response->send();
                }
            } else {
                $aMessages = $oCoursForm->getMessages();
                $sErreurs  = '';

                foreach ($aMessages as $sMessage) {
                    $sErreurs .= '- ' . $sMessage . '<br />';
                }

                $this->view->erreurs = $sErreurs;
            }
        } else {
            $oCoursForm = new CoursForm(null);
        }

        $this->view->cours_form = $oCoursForm;
    }

    public function modifierAction()
    {
        $this->tag->appendTitle(' - Modifier un cours');
        $nCoursId = $this->dispatcher->getParam('id');

        $oCoursForm = null;

        if (true === $this->request->isPost()) {
            $oCoursForm = new CoursForm();

            if (true === $oCoursForm->isValid($this->request->getPost())) {
                $oContenu = $this->api->put('cours/modifier/' . $nCoursId, $this->request->getPost());
                if ($oContenu instanceof \NovaMooc\Library\ApplicationErreur) {
                    $this->view->erreurs = $oContenu->getMessage();
                } else {

                    $this->response->redirect('enseignant');
                    return $this->response->send();
                }
            } else {
                $aMessages = $oCoursForm->getMessages();
                $sErreurs  = '';

                foreach ($aMessages as $sMessage) {
                    $sErreurs .= '- ' . $sMessage . '<br />';
                }

                $this->view->erreurs = $sErreurs;
            }
        } else {
            $oCours     = $this->api->get('cours/' . $nCoursId);
            $oCoursForm = new CoursForm($oCours);
        }

        $this->view->cours_form = $oCoursForm;
    }

    public function supprimerAction()
    {
        $nCoursId = $this->dispatcher->getParam('id');
        $oContenu = $this->api->delete('cours/supprimer/' . $nCoursId);

        $this->response->redirect('enseignant');
        return $this->response->send();
    }
}