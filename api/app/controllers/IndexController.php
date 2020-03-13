<?php

use NovaMooc\Models\NovUsers;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->response->redirect('/api_doc/index.html');
        $this->response->send();
    }

    /**
     * @api {post} /api/connexion Permet d'authentifier un utilisateur
     * @apiName connexionUtilisateur
     * @apiGroup NovUsers
     * @apiExample {curl} Exemple d'utilisation:
     *     curl -i -X POST -d '{"email":"conor.doe@les-enovateurs.com", "password":"azert"}' http://127.0.0.1/api/connexion
     *
     * @apiSuccess {Object} payload Contient les informations de l'utilisateur fraîchement connecté
     *
     * @apiVersion 0.0.1
     */
    public function connexionAction()
    {
        $oUtilisateur = $this->request->getJsonRawBody();

        $oUtilisateurConnexion = NovUsers::findFirst([
            'conditions' => 'email = :email: and password = :password:',
            'bind'       => [
                'email'        => $oUtilisateur->email,
                'password' => $oUtilisateur->password
            ]
        ]);

        if ($oUtilisateurConnexion instanceof NovUsers) {
            return [
                'utilisateur' => $oUtilisateurConnexion,
                'token'       => SecurityPlugin::genereToken($this->config, $oUtilisateurConnexion->id)
            ];
        }

        throw new \Exception('Utilisateur inexistant', SecurityPlugin::CODE_ERREUR_APPLICATIF);
    }

    /**
     * @api {post} /api/inscription Création d'un nouvel utilisateur
     * @apiName InscriptionUtilisateur
     * @apiGroup NovUsers
     * @apiExample {curl} Exemple d'utilisation:
     *     curl -i -X POST -d '{"lastname":"DOE","firstname":"Conor","email":"conor.doe@les-enovateurs.com", "password":"azert"}' http://127.0.0.1/api/inscription
     *
     * @apiSuccess {Object} payload Renvoie le nouvel utilisateur crée
     *
     * @apiVersion 0.0.1
     */
    public function inscriptionAction()
    {
        $aUtilisateur = $this->request->getJsonRawBody(true);

        $oUtilisateur = new NovUsers();
        $oUtilisateur->assign($aUtilisateur);
        $bSauvegarde  = $oUtilisateur->save();

        if (true == $bSauvegarde) {
            return [
                'utilisateur' => $oUtilisateur,
                'token'       => SecurityPlugin::genereToken($this->config, $oUtilisateur->id)
            ];
        } else {
            throw new \Exception('Utilisateur déjà existant', SecurityPlugin::CODE_ERREUR_APPLICATIF);
        }
    }

    public function santeAction(){
        return ['etat' => 'A 100%, prêt à décrocher les étoiles !'];
    }
}

