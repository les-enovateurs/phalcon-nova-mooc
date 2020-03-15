<?php

use NovaMooc\Forms\CourseForm;

class CoursesController extends ControllerBase
{
    public function newAction()
    {
        $this->tag->appendTitle(' - New course');

        $oCourseForm = null;

        if (true === $this->request->isPost()) {
            $oCourseForm = new CourseForm();

            if (true === $oCourseForm->isValid($this->request->getPost())) {
                $oContent = $this->api->post('course/new', $this->request->getPost());
                if ($oContent instanceof \NovaMooc\Library\AppError) {
                    $this->view->errors = $oContent->getMessage();
                } else {

                    $this->response->redirect('teacher');
                    return $this->response->send();
                }
            } else {
                $aMessages = $oCourseForm->getMessages();
                $sErrors  = '';

                foreach ($aMessages as $sMessage) {
                    $sErrors .= '- ' . $sMessage . '<br />';
                }

                $this->view->errors = $sErrors;
            }
        } else {
            $oCourseForm = new CourseForm(null);
        }

        $this->view->course_form = $oCourseForm;
    }

    public function updateAction()
    {
        $this->tag->appendTitle(' - Update a course');
        $nCourseId = $this->dispatcher->getParam('id');

        $oCourseForm = null;

        if (true === $this->request->isPost()) {
            $oCourseForm = new CourseForm();

            if (true === $oCourseForm->isValid($this->request->getPost())) {
                $oContent = $this->api->put('course/update/' . $nCourseId, $this->request->getPost());
                if ($oContent instanceof \NovaMooc\Library\AppError) {
                    $this->view->errors = $oContent->getMessage();
                } else {
                    $this->response->redirect('teacher');
                    return $this->response->send();
                }
            } else {
                $aMessages = $oCourseForm->getMessages();
                $sErrors  = '';

                foreach ($aMessages as $sMessage) {
                    $sErrors .= '- ' . $sMessage . '<br />';
                }

                $this->view->errors = $sErrors;
            }
        } else {
            $oCourse     = $this->api->get('course/' . $nCourseId);
            $oCourseForm = new CourseForm($oCourse);
        }

        $this->view->course_form = $oCourseForm;
    }

    public function deleteAction()
    {
        $nCourseId  = $this->dispatcher->getParam('id');
        $oContent   = $this->api->delete('course/delete/' . $nCourseId);

        $this->response->redirect('teacher');
        return $this->response->send();
    }
}