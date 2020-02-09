<?php

use NovaMooc\Models\Utilisateurs;

class UtilisateursController extends ControllerBase
{
    /**
     * @api {get} /api/utilisateur Récupération de l'utilisateur connecté
     * @apiName infoUtilisateur
     * @apiGroup Utilisateurs
     * @apiExample {curl} Exemple d'utilisation:
     *     curl -i -X GET -d '{"token":"..."}' http://127.0.0.1/api/utilisateur
     *
     * @apiSuccess {Object} payload Contient les informations de l'utilisateur connecté
     *
     * @apiVersion 0.0.1
     */
    public function infoUtilisateurAction()
    {
        $oUtilisateurConnecte = $this->di->getUtilisateur();
        return $oUtilisateurConnecte;
    }

    /**
     * @api {get} /api/cours Récupére les cours gérés par l'utilisateur
     * @apiName coursUtilisateur
     * @apiGroup Utilisateurs
     * @apiExample {curl} Exemple d'utilisation:
     *     curl -i -X GET -d '{"token":"..."}' http://127.0.0.1/api/cours
     *
     * @apiSuccess {Array} payload Contient un tableau de cours
     *
     * @apiVersion 0.0.1
     */
    public function coursAction()
    {
        $oUtilisateurConnecte = $this->di->getUtilisateur();

        if ($oUtilisateurConnecte instanceof Utilisateurs) {
            return $oUtilisateurConnecte->cours;
        }
    }
}