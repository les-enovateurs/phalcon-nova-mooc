<?php

use NovaMooc\Models\Courses;

class CoursesController extends ControllerBase
{
    /**
     * @api {post} /api/course/new Allow to create new course
     * @apiName newCourses
     * @apiGroup Courses
     * @apiExample {curl} Example of use:
     *     curl -i -X POST -d '{"token":"...", "lastname":"Phalcon", "description":"An amazing framework"}' http://127.0.0.1/api/course/new
     *
     * @apiSuccess {Object} payload Get informations about the new course
     *
     * @apiVersion 0.0.1
     */
    public function newAction()
    {
        $aCourse                   = $this->request->getJsonRawBody(true);
        $oConnectedUser             = $this->di->getUser();
        $aCourse['nov_users_id']   = $oConnectedUser->id;

        $oCourse      = new Courses();
        $oCourse->assign($aCourse);

        $bSave = $oCourse->save();

        if (true == $bSave) {
            return [
                'course' => $oCourse,
            ];
        } else {
            throw new \Exception('Create a new course failed', SecurityPlugin::CODE_ERROR_APP);
        }
    }

    /**
     * @api {get} /api/cours/:id Get one course
     * @apiParam {Integer} id The course ID to return
     * @apiName infoCourses
     * @apiGroup Courses
     * @apiExample {curl} Example of use:
     *     curl -i -X GET -d '{"token":"..."}' http://127.0.0.1/api/course/1
     *
     * @apiSuccess {Object} payload Get informations about the course
     *
     * @apiVersion 0.0.1
     */
    public function infoCourseAction()
    {
        $nCoursId             = $this->dispatcher->getParam('id');
        $aToken               = $this->request->getJsonRawBody(true);
        $oUtilisateurConnecte = $this->di->getUser();
        return Courses::findFirst([
            'conditions' => 'nov_users_id = :nov_users_id: and id = :id:',
            'bind'       => [
                'nov_users_id' => $oUtilisateurConnecte->id,
                'id'              => $nCoursId
            ]
        ]);
    }

    /**
     * @api {put} /api/course/update/:id Update an existant course
     * @apiParam {Integer} id The course's id to update
     * @apiName updateCourse
     * @apiGroup Courses
     * @apiExample {curl} Example of use:
     *     curl -i -X GET -d '{"token":"...", "lastname":"Phalcon 4", "description":"The new version of Phalcon"}' http://127.0.0.1/api/course/update/1
     *
     * @apiSuccess {Object} payload Content informations about the course's update
     *
     * @apiVersion 0.0.1
     */
    public function updateAction()
    {
        $nCourseId                  = $this->dispatcher->getParam('id');
        $aCourse                    = $this->request->getJsonRawBody(true);
        $oConnectedUser             = $this->di->getUser();
        $aCourse['nov_users_id']    = $oConnectedUser->id;

        $oCourse = Courses::findFirst([
            'conditions' => 'nov_users_id = :nov_users_id: and id = :id:',
            'bind'       => [
                'nov_users_id' => $oConnectedUser->id,
                'id'           => $nCourseId
            ]
        ]);

        if ($oCourse instanceof Courses) {
            $oCourse->assign($aCourse);
            $bSave = $oCourse->save();

            if (true == $bSave) {
                return [
                    'course' => $oCourse,
                ];
            } else {
                throw new \Exception('Update course failed', SecurityPlugin::CODE_ERROR_APP);
            }
        }

        throw new \Exception('Course not found', SecurityPlugin::CODE_ERROR_APP);
    }

    /**
     * @api {delete} /api/course/delete/:id Delete a course
     * @apiParam {Integer} id The course's id to delete
     * @apiName deleteCourse
     * @apiGroup Courses
     * @apiExample {curl} Example of use:
     *     curl -i -X GET -d '{"token":"..."}' http://127.0.0.1/api/course/delete/1
     *
     * @apiSuccess {Boolean} payload Indicates if the course has been deleted
     *
     * @apiVersion 0.0.1
     */
    public function deleteAction()
    {
        $nCourseId      = $this->dispatcher->getParam('id');
        $aCourse        = $this->request->getJsonRawBody(true);
        $oConnectedUser = $this->di->getUser();

        $oCourse = Courses::findFirst([
            'conditions' => 'nov_users_id = :nov_users_id: and id = :id:',
            'bind'       => [
                'nov_users_id' => $oConnectedUser->id,
                'id'           => $nCourseId
            ]
        ]);

        if ($oCourse instanceof Courses) {
            $bDelete = $oCourse->delete();

            if (true == $bDelete) {
                return [
                    'state' => $bDelete,
                ];
            } else {
                throw new \Exception('Delete course failed', SecurityPlugin::CODE_ERROR_APP);
            }
        }

        throw new \Exception('Course not found', SecurityPlugin::CODE_ERROR_APP);
    }
}