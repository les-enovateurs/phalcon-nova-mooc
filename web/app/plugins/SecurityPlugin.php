<?php

use Phalcon\Events\Event;
use Phalcon\Di\Injectable;
use Phalcon\Mvc\Dispatcher;

class SecurityPlugin extends Injectable
{
    const CODE_ERREUR_APPLICATIF   = 508;
    const CODE_ERREUR_SERVEUR      = 500;
    const CODE_ERREUR_NON_TROUVE   = 404;
    const CODE_ERREUR_ACCES_REFUSE = 401;
    const CODE_SUCCES              = 200;

    const PAGE_PUBLIC = [
        'index/inscription',
        'index/index',
        'index/sante',
        'erreur/code401',
        'erreur/code404',
        'erreur/code500',
    ];

    //Avant de gérer une requête extérieur
    public function beforeHandleRoute(Event $oEvent, Dispatcher $oDispatcher)
    {
        //Vérification de l'adresse IP entrante
        $aListeNoirIp = [
            '1-free-share-buttons.com',
            'adviceforum.info'
        ];

        $sAdresseIp = $this->request->getClientAddress();

        if (true === in_array($sAdresseIp, $aListeNoirIp)) {
            throw new \Exception('Accès interdit à cette page', self::CODE_ERREUR_ACCES_REFUSE);

            return false;
        }

        return true;
    }

    public function beforeExecuteRoute(Event $oEvent, Dispatcher $oDispatcher)
    {

        $oUtilisateur = null;
        if (true === $this->session->has('utilisateur')) {
            $oUtilisateur            = $this->session->get('utilisateur');
            $this->view->utilisateur = $oUtilisateur;
        }

        $sControleur = $oDispatcher->getControllerName();
        $sAction     = $oDispatcher->getActionName();

        if (true === is_null($oUtilisateur)
            && false === in_array($sControleur . '/' . $sAction, self::PAGE_PUBLIC)){
            throw new \Exception('Accès interdit à cette page', self::CODE_ERREUR_ACCES_REFUSE);

            return false;
        }
    }

    // Gestion de page introuvable
    public function beforeNotFoundAction()
    {
        throw new \Exception('Page introuvable', self::CODE_ERREUR_NON_TROUVE);

        return false;
    }

    public function beforeException(Event $oEvent, Dispatcher $oDispatcher, \Exception $oException)
    {
        $this->logger->error(json_encode([
            'code'    => $oException->getCode(),
            'message' => $oException->getMessage()
        ]));

        if (true === in_array($oException->getCode(), [ self::CODE_ERREUR_ACCES_REFUSE, self::CODE_ERREUR_NON_TROUVE ])) {
            $this->response->redirect('erreur/code' . $oException->getCode());
            return $this->response->send();
        }

        $this->response->redirect('erreur/code' . self::CODE_ERREUR_SERVEUR);
        return $this->response->send();
    }
}