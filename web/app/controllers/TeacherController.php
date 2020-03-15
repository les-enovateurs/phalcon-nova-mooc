<?php

use Phalcon\Mvc\View;

class TeacherController extends ControllerBase
{
    public function indexAction()
    {
        $this->tag->appendTitle(' - Dashboard');

        $this->view->courses = $this->api->get('user/courses');
    }
}

