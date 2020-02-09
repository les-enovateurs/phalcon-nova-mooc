<?php

use Phalcon\Mvc\View;

class EnseignantController extends ControllerBase
{
    public function indexAction()
    {
        $this->tag->appendTitle(' - Tableau de bord');

        $this->view->cours = $this->api->get('utilisateur/cours');
    }
}

