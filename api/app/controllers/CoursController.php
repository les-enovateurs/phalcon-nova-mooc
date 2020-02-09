<?php

use NovaMooc\Models\Cours;

class CoursController extends ControllerBase
{
    /**
     * @api {post} /api/cours/nouveau Permet de créer un nouveau cours et de l'associer à l'utilisateur connecté
     * @apiName nouveauCours
     * @apiGroup Cours
     * @apiExample {curl} Exemple d'utilisation:
     *     curl -i -X POST -d '{"token":"...", "nom":"Phalcon", "description":"Un formation dingue"}' http://127.0.0.1/api/cours/nouveau
     *
     * @apiSuccess {Object} payload Contient les informations du cours fraîchement crée
     *
     * @apiVersion 0.0.1
     */
    public function nouveauAction()
    {
        $aCours                    = $this->request->getJsonRawBody(true);
        $oUtilisateurConnecte      = $this->di->getUtilisateur();
        $aCours['utilisateurs_id'] = $oUtilisateurConnecte->id;

        $oCours      = new Cours();
        $oCours->assign($aCours);
        $bSauvegarde = $oCours->save();

        if (true == $bSauvegarde) {
            return [
                'cours' => $oCours,
            ];
        } else {
            throw new \Exception('Le cours n\'a pas pu être crée', SecurityPlugin::CODE_ERREUR_APPLICATIF);
        }
    }

    /**
     * @api {get} /api/cours/:id Récupération d'un cours
     * @apiParam {Integer} id L'ID du cours à renvoyer.
     * @apiName infoCours
     * @apiGroup Cours
     * @apiExample {curl} Exemple d'utilisation:
     *     curl -i -X GET -d '{"token":"..."}' http://127.0.0.1/api/cours/1
     *
     * @apiSuccess {Object} payload Contient les informations du cours
     *
     * @apiVersion 0.0.1
     */
    public function infoCoursAction()
    {
        $nCoursId             = $this->dispatcher->getParam('id');
        $aToken               = $this->request->getJsonRawBody(true);
        $oUtilisateurConnecte = $this->di->getUtilisateur();
        return Cours::findFirst([
            'conditions' => 'utilisateurs_id = :utilisateurs_id: and id = :id:',
            'bind'       => [
                'utilisateurs_id' => $oUtilisateurConnecte->id,
                'id'              => $nCoursId
            ]
        ]);
    }

    /**
     * @api {put} /api/cours/modifier/:id Modifier un cours existant
     * @apiParam {Integer} id L'ID du cours à renvoyer.
     * @apiName modifierCours
     * @apiGroup Cours
     * @apiExample {curl} Exemple d'utilisation:
     *     curl -i -X GET -d '{"token":"...", "nom":"Phalcon 4", "description":"Nouvelle version de Phalcon"}' http://127.0.0.1/api/cours/modifier/1
     *
     * @apiSuccess {Object} payload Contient les informations du cours actualisées
     *
     * @apiVersion 0.0.1
     */
    public function modifierAction()
    {
        $nCoursId                  = $this->dispatcher->getParam('id');
        $aCours                    = $this->request->getJsonRawBody(true);
        $oUtilisateurConnecte      = $this->di->getUtilisateur();
        $aCours['utilisateurs_id'] = $oUtilisateurConnecte->id;

        $oCours = Cours::findFirst([
            'conditions' => 'utilisateurs_id = :utilisateurs_id: and id = :id:',
            'bind'       => [
                'utilisateurs_id' => $oUtilisateurConnecte->id,
                'id'              => $nCoursId
            ]
        ]);

        if ($oCours instanceof Cours) {
            $oCours->assign($aCours);
            $bSauvegarde = $oCours->save();

            if (true == $bSauvegarde) {
                return [
                    'cours' => $oCours,
                ];
            } else {
                throw new \Exception('Le cours n\'a pas pu être modifié', SecurityPlugin::CODE_ERREUR_APPLICATIF);
            }
        }

        throw new \Exception('Cours inexistant', SecurityPlugin::CODE_ERREUR_APPLICATIF);
    }

    /**
     * @api {delete} /api/cours/supprimer/:id Supprimer un cours existant
     * @apiParam {Integer} id L'ID du cours à supprimer.
     * @apiName supprimerCours
     * @apiGroup Cours
     * @apiExample {curl} Exemple d'utilisation:
     *     curl -i -X GET -d '{"token":"..."}' http://127.0.0.1/api/cours/supprimer/1
     *
     * @apiSuccess {Boolean} payload Indique si le cours a été supprimé
     *
     * @apiVersion 0.0.1
     */
    public function supprimerAction()
    {
        $nCoursId             = $this->dispatcher->getParam('id');
        $aCours               = $this->request->getJsonRawBody(true);
        $oUtilisateurConnecte = $this->di->getUtilisateur();

        $oCours = Cours::findFirst([
            'conditions' => 'utilisateurs_id = :utilisateurs_id: and id = :id:',
            'bind'       => [
                'utilisateurs_id' => $oUtilisateurConnecte->id,
                'id'              => $nCoursId
            ]
        ]);

        if ($oCours instanceof Cours) {
            $bSuppression = $oCours->delete();

            if (true == $bSuppression) {
                return [
                    'etat' => $bSuppression,
                ];
            } else {
                throw new \Exception('Le cours n\'a pas pu être supprimé', SecurityPlugin::CODE_ERREUR_APPLICATIF);
            }
        }

        throw new \Exception('Cours inexistant', SecurityPlugin::CODE_ERREUR_APPLICATIF);
    }
}