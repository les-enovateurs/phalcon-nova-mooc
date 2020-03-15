<?php

namespace NovaMooc\Library;

use GuzzleHttp\Client as GuzzleClient;

class ClientApi
{
    const METHOD_ACCEPT = [ 'GET', 'POST', 'PUT', 'DELETE' ];
    private $oClient;
    private $oSession;

    public function __construct($sUrlApi = null, $oSession)
    {
        $oClient        = new GuzzleClient([
            'base_uri' => $sUrlApi,
            'timeout'  => 2,
            'headers'  => [
                'User-Agent' => 'MoocWeb/1.0',
                'Accept'     => 'application/json',
            ]
        ]);
        $this->oClient  = $oClient;
        $this->oSession = $oSession;
    }

    public function __call($sMethode, $aProprietes)
    {
        $sRoute      = $aProprietes[0];
        $aParametres = [];

        if (count($aProprietes) > 1) {
            $aParametres = $aProprietes[1];
        }

        $sMethode = strtoupper($sMethode);

        if (false === in_array($sMethode, self::METHOD_ACCEPT)) {
            throw new \Exception('La méthode ' . $sMethode . ' est bloqué', \SecurityPlugin::CODE_ERROR_SERVER);
            return false;
        }

        $aParametres = array_merge($aParametres, [ 'token' => $this->oSession->get('token') ]);

        try {
            $oReponse = $this->oClient->request(strtoupper($sMethode), $sRoute, [ 'json' => $aParametres ]);
        } catch (\Exception $e) {
            switch (get_class($e)) {
                case 'GuzzleHttp\Exception\ClientException':
                case 'GuzzleHttp\Exception\ServerException':

                    if (\SecurityPlugin::CODE_ERROR_APP == $e->getCode()) {
                        return new AppError($e->getResponse()->getBody()->getContents());
                    }
                    throw new \Exception($e->getResponse()->getBody()->getContents(), $e->getCode());
                    break;
                default:
                    throw new \Exception($e->getMessage(), $e->getCode());
            }
        }
        $oContent = json_decode($oReponse->getBody());

        return $oContent->payload;
    }
}