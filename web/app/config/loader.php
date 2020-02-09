<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->formsDir,
        $config->application->pluginsDir
    ]
)->register();


$loader->registerNamespaces(
    [
        'NovaMooc\Forms'   => $config->application->formsDir,
        'NovaMooc\Library' => $config->application->libraryDir
    ]
);

$loader->register();




