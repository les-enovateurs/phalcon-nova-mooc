<?php

$router = $di->getRouter();

// Define your routes here
$router->addGet('/api/sante', [
    'controller' => 'index',
    'action'     => 'sante',
])->setName('sante_index');

$router->addPost('/api/connexion', [
    'controller' => 'index',
    'action'     => 'connexion',
])->setName('connexion_index');

$router->addPost('/api/inscription', [
    'controller' => 'index',
    'action'     => 'inscription',
])->setName('inscription_index');

$router->addGet('/api/utilisateur/{id:[0-9]+}', [
    'controller' => 'utilisateurs',
    'action'     => 'infoUtilisateur',
])->setName('info_utilisateur');

$router->addPost('/api/utilisateur', [
    'controller' => 'utilisateurs',
    'action'     => 'nouvel',
])->setName('nouveau_utilisateur');

$router->addGet('/api/utilisateur/cours', [
    'controller' => 'utilisateurs',
    'action'     => 'cours',
])->setName('cours_utilisateur');

$router->addGet('/api/cours/{id:[0-9]+}', [
    'controller' => 'cours',
    'action'     => 'infoCours',
])->setName('cours_info');

$router->addPost('/api/cours/nouveau', [
    'controller' => 'cours',
    'action'     => 'nouveau',
])->setName('cours_nouveau');

$router->addPut('/api/cours/modifier/{id:[0-9]+}', [
    'controller' => 'cours',
    'action'     => 'modifier',
])->setName('cours_modifier');

$router->addDelete('/api/cours/supprimer/{id:[0-9]+}', [
    'controller' => 'cours',
    'action'     => 'supprimer',
])->setName('cours_supprimer');

$router->handle($_GET['_url'] ?? '/');
