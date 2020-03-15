<?php

use NovaMooc\Models\Users;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->response->redirect('/api_doc/index.html');
        $this->response->send();
    }

    /**
     * @api {post} /api/login Login a user
     * @apiName loginUser
     * @apiGroup Users
     * @apiExample {curl} Example of use:
     *     curl -i -X POST -d '{"email":"conor.doe@les-enovateurs.com", "password":"azert"}' http://127.0.0.1/api/login
     *
     * @apiSuccess {Object} payload Has informations about the new connected user
     *
     * @apiVersion 0.0.1
     */
    public function loginAction()
    {
        $oUser = $this->request->getJsonRawBody();

        $oConnectedUser = Users::findFirst([
            'conditions' => 'email = :email: and password = :password:',
            'bind'       => [
                'email'    => $oUser->email,
                'password' => $oUser->password
            ]
        ]);

        if ($oConnectedUser instanceof Users) {
            return [
                'user' => $oConnectedUser,
                'token'=> SecurityPlugin::generateToken($this->config, $oConnectedUser->id)
            ];
        }

        throw new \Exception('User not found', SecurityPlugin::CODE_ERROR_APP);
    }

    /**
     * @api {post} /api/register Create a new user
     * @apiName RegisterUser
     * @apiGroup User
     * @apiExample {curl} Example of use:
     *     curl -i -X POST -d '{"lastname":"DOE","firstname":"Conor","email":"conor.doe@les-enovateurs.com", "password":"azert"}' http://127.0.0.1/api/register
     *
     * @apiSuccess {Object} payload Returns the new user created
     *
     * @apiVersion 0.0.1
     */
    public function registerAction()
    {
        $aUser = $this->request->getJsonRawBody(true);

        $oUser = new Users();
        $oUser->assign($aUser);
        $bSave  = $oUser->save();

        if (true == $bSave) {
            return [
                'user' => $oUser,
                'token'=> SecurityPlugin::generateToken($this->config, $oUser->id)
            ];
        } else {
            throw new \Exception('User already exists', SecurityPlugin::CODE_ERROR_APP);
        }
    }

    public function healthAction(){
        return ['state' => '100% ready to take down the stars!'];
    }
}

