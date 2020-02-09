<?php

$router = $di->getRouter();

$router->add('/sante', [
    'controller' => 'index',
    'action'     => 'sante',
])->setName('sante');

/** Authentification */
// Inscription
$router->add('/inscription', [
    'controller' => 'index',
    'action'     => 'inscription',
])->setName('inscription');

$router->add('/deconnexion', [
    'controller' => 'index',
    'action'     => 'deconnexion',
])->setName('deconnexion');

$router->add('/cours/nouveau', [
    'controller' => 'cours',
    'action'     => 'nouveau',
])->setName('nouveau_cours');

$router->add('/cours/modifier/{id:[0-9]+}', [
    'controller' => 'cours',
    'action'     => 'modifier',
])->setName('modifier_cours');

$router->add('/cours/supprimer/{id:[0-9]+}', [
    'controller' => 'cours',
    'action'     => 'supprimer',
])->setName('supprimer_cours');

$router->handle($_GET['_url'] ?? '/');
