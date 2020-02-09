<?php


namespace NovaMooc\Library;


use GuzzleHttp\Client as GuzzleClient;

class ApplicationErreur
{
    private $sMessage;

    public function __construct($sJsonMessage)
    {
        $oReponse = json_decode($sJsonMessage);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \Exception('JSON malformé : '.$sJsonMessage, self::CODE_ERREUR_SERVEUR);
            return false;
        }

        $this->sMessage = $oReponse->message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->sMessage;
    }
}