<?php

use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Phalcon\Events\Event;
use Phalcon\Di\Injectable;
use Phalcon\Mvc\Dispatcher;

use Lcobucci\JWT\Builder;

class SecurityPlugin extends Injectable
{
    const CODE_ERROR_APP            = 508;
    const CODE_ERROR_SERVER         = 500;
    const CODE_ERROR_NOT_FOUND      = 404;
    const CODE_ERROR_ACCESS_DENIED  = 401;
    const CODE_SUCCESS              = 200;

    //Before handling an external request
    public function beforeHandleRoute(Event $oEvent, Dispatcher $oDispatcher)
    {
        //Checking the incoming IP address
        $aIncludeListIP = [
            '127.0.0.1',
            gethostbyname('mooc-web'),
            '::1'
        ];

        $sIpAdress      = $this->request->getClientAddress();
        if (false === in_array($sIpAdress, $aIncludeListIP)) {
            throw new \Exception('Access denied', self::CODE_ERROR_ACCESS_DENIED);

            return false;
        }

        if ($this->request->getHeader('ORIGIN')) {
            $sOrigin = $this->request->getHeader('ORIGIN');
        } else {
            $sOrigin = '*';
        }

        //Add informations about CORS - Cross-Origin Resource Sharing
        $this->response
            ->setHeader('Access-Control-Allow-Origin', $sOrigin)
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

    // Before execute the route
    public function beforeExecuteRoute(Event $oEvent, Dispatcher $oDispatcher)
    {
        $sParameters = $this->request->getRawBody();

        if('' !== $sParameters){
            //Check data received
            json_decode($this->request->getRawBody());
            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \Exception('JSON malformed', self::CODE_ERROR_SERVER);

                return false;
            }
        }

        return true;
    }

    // Handle Error 404 - Not FOund
    public function beforeNotFoundAction()
    {
        throw new \Exception('Not Found', self::CODE_ERROR_NOT_FOUND);

        return false;
    }

    public function beforeException(Event $oEvent, Dispatcher $oDispatcher, \Exception $oException)
    {
        $nCode          = self::CODE_ERROR_SERVER;
        $sMessageStatus = 'Serveur Error';

        if (true === in_array($oException->getCode(), [ self::CODE_ERROR_ACCESS_DENIED, self::CODE_ERROR_NOT_FOUND, self::CODE_ERROR_APP ])) {
            $nCode          = $oException->getCode();
            $sMessageStatus = $oException->getMessage();
        }

        $this->response->setJsonContent(
            [
                'code'    => $oException->getCode(),
                'status'  => 'error',
                'message' => $oException->getMessage(),
            ]
        );

        $this->response->setStatusCode($nCode, $sMessageStatus);

        return $this->response->send();
    }

    public static function generateToken($oConfig, $nId){
        return (new Builder())
            ->withClaim('user_id', $nId)
            ->issuedAt(time())
            ->getToken(new Lcobucci\JWT\Signer\Hmac\Sha256(), new \Lcobucci\JWT\Signer\Key($oConfig->security->key))
            ->__toString();
    }

    public static function getUserIdFromToken($oConfig, $sToken){
        $oToken  = (new Parser())->parse($sToken);
        if ($oToken instanceof \Lcobucci\JWT\Token
            && true === $oToken->verify(new Lcobucci\JWT\Signer\Hmac\Sha256(), $oConfig->security->key)) {
            return $oToken->getClaim('user_id');
        }
        return false;
    }
}