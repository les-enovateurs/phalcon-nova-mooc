<?php

$router = $di->getRouter();

$router->add('/health', [
    'controller' => 'index',
    'action'     => 'health',
])->setName('health');

/** Authentication */
// Register
$router->add('/register', [
    'controller' => 'index',
    'action'     => 'register',
])->setName('register');

$router->add('/logout', [
    'controller' => 'index',
    'action'     => 'logout',
])->setName('logout');

$router->add('/course/new', [
    'controller' => 'courses',
    'action'     => 'new',
])->setName('new_course');

$router->add('/course/update/{id:[0-9]+}', [
    'controller' => 'courses',
    'action'     => 'update',
])->setName('update_course');

$router->add('/course/delete/{id:[0-9]+}', [
    'controller' => 'courses',
    'action'     => 'delete',
])->setName('delete_course');

$router->handle($_GET['_url'] ?? '/');
