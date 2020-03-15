<?php

use NovaMooc\Models\Users;

class UsersController extends ControllerBase
{
    /**
     * @api {get} /api/user Get connected user
     * @apiName infoUser
     * @apiGroup Users
     * @apiExample {curl} Example of use:
     *     curl -i -X GET -d '{"token":"..."}' http://127.0.0.1/api/user
     *
     * @apiSuccess {Object} payload Contains the information of the logged in user
     *
     * @apiVersion 0.0.1
     */
    public function infoUserAction()
    {
        $oConnectedUser = $this->di->getUser();
        return $oConnectedUser;
    }

    /**
     * @api {get} /api/user/courses Get courses created by a User
     * @apiName coursesUser
     * @apiGroup Users
     * @apiExample {curl} Example of use:
     *     curl -i -X GET -d '{"token":"..."}' http://127.0.0.1/api/courses
     *
     * @apiSuccess {Array} payload Get an array of courses
     *
     * @apiVersion 0.0.1
     */
    public function coursesAction()
    {
        $oConnectedUser = $this->di->getUser();

        if ($oConnectedUser instanceof Users) {
            return $oConnectedUser->courses;
        }
    }
}