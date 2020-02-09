<?php

use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Phalcon\Events\Event;
use Phalcon\Di\Injectable;
use Phalcon\Mvc\Dispatcher;

use Lcobucci\JWT\Builder;

class SecurityPlugin extends Injectable
{
    const CODE_ERREUR_APPLICATIF   = 508;
    const CODE_ERREUR_SERVEUR      = 500;
    const CODE_ERREUR_NON_TROUVE   = 404;
    const CODE_ERREUR_ACCES_REFUSE = 401;
    const CODE_SUCCES              = 200;

    //Avant de gérer une requête extérieur
    public function beforeHandleRoute(Event $oEvent, Dispatcher $oDispatcher)
    {
        //Vérification de l'adresse IP entrante
        $aListeBlancheIp = [
            '127.0.0.1',
            '192.168.99.100',
            '192.168.48.1',
            '::1'
        ];

        $sAdresseIp      = $this->request->getClientAddress();
        //echo $sAdresseIp;die;
        if (false === in_array($sAdresseIp, $aListeBlancheIp)) {
            throw new \Exception('Accès interdit à cette page', self::CODE_ERREUR_ACCES_REFUSE);

            return false;
        }

        if ($this->request->getHeader('ORIGIN')) {
            $sOrigine = $this->request->getHeader('ORIGIN');
        } else {
            $sOrigine = '*';
        }

        //Ajout des informations CORS - Cross-Origin Resource Sharing
        $this->response
            ->setHeader('Access-Control-Allow-Origin', $sOrigine)
            ->setHeader(
                'Access-Control-Allow-Methods',
                'GET,PUT,POST,DELETE,OPTIONS'
            )
            ->setHeader('Access-Control-Allow-Headers',
                'Origin, X-Requested-With, Content-Range, ' .
                'Content-Disposition, Content-Type, Authorization'
            )
            ->setHeader('Access-Control-Allow-Credentials', 'true');

        return true;
    }

    // Avant l'exécution d'une route
    public function beforeExecuteRoute(Event $oEvent, Dispatcher $oDispatcher)
    {
        $sParametres = $this->request->getRawBody();

        if('' !== $sParametres){
            //Vérification des données reçu
            json_decode($this->request->getRawBody());
            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \Exception('JSON malformé', self::CODE_ERREUR_SERVEUR);

                return false;
            }
        }

        return true;
    }

    // Gestion de page introuvable
    public function beforeNotFoundAction()
    {
        throw new \Exception('Page introuvable', self::CODE_ERREUR_NON_TROUVE);

        return false;
    }

    public function beforeException(Event $oEvent, Dispatcher $oDispatcher, \Exception $oException)
    {
        $nCode          = self::CODE_ERREUR_SERVEUR;
        $sMessageStatus = 'Serveur Erreur';

        if (true === in_array($oException->getCode(), [ self::CODE_ERREUR_ACCES_REFUSE, self::CODE_ERREUR_NON_TROUVE, self::CODE_ERREUR_APPLICATIF ])) {
            $nCode          = $oException->getCode();
            $sMessageStatus = $oException->getMessage();
        }

        $this->response->setJsonContent(
            [
                'code'    => $oException->getCode(),
                'status'  => 'erreur',
                'message' => $oException->getMessage(),
            ]
        );

        $this->response->setStatusCode($nCode, $sMessageStatus);

        return $this->response->send();
    }

    public static function genereToken($oConfig, $nId){
        return (new Builder())
            ->withClaim('utilisateur_id', $nId)
            ->issuedAt(time())
            ->getToken(new Lcobucci\JWT\Signer\Hmac\Sha256(), new \Lcobucci\JWT\Signer\Key($oConfig->security->cle))
            ->__toString();
    }

    public static function getUtilisateurIdFromToken($oConfig, $sToken){
        $oToken  = (new Parser())->parse($sToken);
        if ($oToken instanceof \Lcobucci\JWT\Token
            && true === $oToken->verify(new Lcobucci\JWT\Signer\Hmac\Sha256(), $oConfig->security->cle)) {
            return $oToken->getClaim('utilisateur_id');
        }
        return false;
    }
}