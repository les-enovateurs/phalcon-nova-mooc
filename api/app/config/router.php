<?php

$router = $di->getRouter();

// Define your routes here
$router->addGet('/api/health', [
    'controller' => 'index',
    'action'     => 'health',
])->setName('health_index');

$router->addPost('/api/login', [
    'controller' => 'index',
    'action'     => 'login',
])->setName('login_index');

$router->addPost('/api/register', [
    'controller' => 'index',
    'action'     => 'register',
])->setName('register_index');

$router->addGet('/api/user/{id:[0-9]+}', [
    'controller' => 'users',
    'action'     => 'infoUser',
])->setName('info_user');

$router->addPost('/api/user', [
    'controller' => 'users',
    'action'     => 'new',
])->setName('new_user');

$router->addGet('/api/user/courses', [
    'controller' => 'users',
    'action'     => 'courses',
])->setName('courses_user');

$router->addGet('/api/course/{id:[0-9]+}', [
    'controller' => 'courses',
    'action'     => 'infoCourse',
])->setName('info_courses');

$router->addPost('/api/course/new', [
    'controller' => 'courses',
    'action'     => 'new',
])->setName('new_courses');

$router->addPut('/api/course/update/{id:[0-9]+}', [
    'controller' => 'courses',
    'action'     => 'update',
])->setName('update_courses');

$router->addDelete('/api/course/delete/{id:[0-9]+}', [
    'controller' => 'courses',
    'action'     => 'delete',
])->setName('delete_courses');

$router->handle($_GET['_url'] ?? '/');
