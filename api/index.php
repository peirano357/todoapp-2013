<?php
session_cache_limiter(false);
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/api/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
require $_SERVER['DOCUMENT_ROOT'] . '/api/Slim/View.php';

require $_SERVER['DOCUMENT_ROOT'] . '/api/Slim/Log.php';
require $_SERVER['DOCUMENT_ROOT'] . '/api/controller/Controller.php';
require $_SERVER['DOCUMENT_ROOT'] . '/api/controller/Todo.php';
require $_SERVER['DOCUMENT_ROOT'] . '/api/view/Api_View.php';
require $_SERVER['DOCUMENT_ROOT'] . '/api/middleware/SecurityMiddleware.php';

\Slim\Slim::registerAutoloader();
$app = new Slim\Slim();
$app->view(new Api_View($app));
$todo = new Todo($app);

$app->notFound(function ($format = 'json') use ($app) {
            $app->view()->setResponse(array(), 404, 'Not found');
            $app->render($format);
        });

$app->run();
