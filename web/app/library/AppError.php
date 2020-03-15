<?php


namespace NovaMooc\Library;


use GuzzleHttp\Client as GuzzleClient;

class AppError
{
    private $sMessage;

    public function __construct($sJsonMessage)
    {
        $oReponse = json_decode($sJsonMessage);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \Exception('JSON malformed : '.$sJsonMessage, self::CODE_ERROR_SERVER);
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