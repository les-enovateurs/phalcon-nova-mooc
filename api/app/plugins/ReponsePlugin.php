<?php

use Phalcon\Events\Event;
use Phalcon\Di\Injectable;
use Phalcon\Mvc\Dispatcher;

class ReponsePlugin extends Injectable
{
    public function afterExecuteRoute(Event $event, Dispatcher $oDispatcher)
    {
        $this->response->setJsonContent(
            [
                'code'    => SecurityPlugin::CODE_SUCCESS,
                'status'  => 'success',
                'message' => '',
                'payload' => $oDispatcher->getReturnedValue()
            ]
        );

        return $this->response->send();
    }

}