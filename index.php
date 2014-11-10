<?php

require_once 'vendor/autoload.php';

$app = new \Slim\Slim();

$view = $app->view();
$view->setTemplatesDirectory('view');

$app->get('/', function () use ($app) {
	$app->render('accueil.php');
});

$app->run();
?>