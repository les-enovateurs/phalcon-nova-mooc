<?php

use Phalcon\Events\Event;
use Phalcon\Di\Injectable;
use Phalcon\Mvc\Dispatcher;

class SecurityPlugin extends Injectable
{
    const CODE_ERROR_APP            = 508;
    const CODE_ERROR_SERVER         = 500;
    const CODE_ERROR_NOT_FOUND      = 404;
    const CODE_ERROR_ACCESS_DENIED  = 401;
    const CODE_SUCCESS              = 200;

    const PUBLIC_ACCESS = [
        'index/register',
        'index/index',
        'index/health',
        'error/code401',
        'error/code404',
        'error/code500',
    ];

    //Before handling an external request
    public function beforeHandleRoute(Event $oEvent, Dispatcher $oDispatcher)
    {
        //Checking the incoming IP address
        $aExcludedIpList = [
            '1-free-share-buttons.com',
            'adviceforum.info'
        ];

        $sIpAdress = $this->request->getClientAddress();

        if (true === in_array($sIpAdress, $aExcludedIpList)) {
            throw new \Exception('Access denied', self::CODE_ERROR_ACCESS_DENIED);

            return false;
        }

        return true;
    }

    public function beforeExecuteRoute(Event $oEvent, Dispatcher $oDispatcher)
    {
        $oUser = null;
        if (true === $this->session->has('user')) {
            $oUser            = $this->session->get('user');
            $this->view->user = $oUser;
        }

        $sController = $oDispatcher->getControllerName();
        $sAction     = $oDispatcher->getActionName();

        if (true === is_null($oUser)
            && false === in_array($sController . '/' . $sAction, self::PUBLIC_ACCESS)){
            throw new \Exception('Access denied', self::CODE_ERROR_ACCESS_DENIED);

            return false;
        }
    }

    // Handle page not found
    public function beforeNotFoundAction()
    {
        throw new \Exception('Not Found', self::CODE_ERROR_NOT_FOUND);

        return false;
    }

    public function beforeException(Event $oEvent, Dispatcher $oDispatcher, \Exception $oException)
    {
        $this->logger->error(json_encode([
            'code'    => $oException->getCode(),
            'message' => $oException->getMessage()
        ]));

        if (true === in_array($oException->getCode(), [ self::CODE_ERROR_ACCESS_DENIED, self::CODE_ERROR_NOT_FOUND ])) {
            $this->response->redirect('error/code' . $oException->getCode());
            return $this->response->send();
        }

        $this->response->redirect('error/code' . self::CODE_ERROR_SERVER);
        return $this->response->send();
    }
}