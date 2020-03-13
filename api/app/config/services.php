<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Manager as SessionManager;
use Phalcon\Session\Adapter\Stream as SessionStream;
use Phalcon\Flash\Direct as Flash;

use Phalcon\Events\Manager as EventsManager;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
                'path' => $config->application->cacheDir,
                'separator' => '_'
            ]);

            return $volt;
        },
        '.phtml' => PhpEngine::class

    ]);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'port'     => $config->database->port
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $oSession = new SessionManager();
    $oFiles = new SessionStream(
        [
            'savePath' => '/tmp',
        ]
    );
    $oSession->setAdapter($oFiles);
    
    $oSession->start();

    return $oSession;
});


$di->set('dispatcher', function () use ($di) {
    $oGestionnaireEvenements = new EventsManager();

    $oGestionnaireEvenements->attach('dispatch', new SecurityPlugin());
    $oGestionnaireEvenements->attach('dispatch:afterExecuteRoute', new ReponsePlugin());

    $oDispatcher = new Phalcon\Mvc\Dispatcher();
    $oDispatcher->setEventsManager($oGestionnaireEvenements);

    return $oDispatcher;
});

$di->setShared('logger', function () {
    $oAdapter = new Phalcon\Logger\Adapter\Stream(BASE_PATH.'/phalcon.log');
    $oLogger  = new Phalcon\Logger(
        'messages',
        [
            'main' => $oAdapter,
        ]
    );

    $oLogger->setLogLevel(Phalcon\Logger::ERROR);

    return $oLogger;
});

$di->set('utilisateur', function () {
    $oParameter = $this->getRequest()->getJsonRawBody();
    $nUserId    = SecurityPlugin::getUserIdFromToken($this->getConfig(), $oParameter->token);
    $oUser      = NovaMooc\Models\NovUsers::findFirstById($nUserId);

    return $oUser;
});