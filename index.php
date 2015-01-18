<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
	'view' => '\Slim\LayoutView', // I activate slim layout component
	'layout' => 'layouts/main.php' // I define my main layout
));

$view = $app->view();
$view->setTemplatesDirectory('view');

$app->get('/', function () use ($app) {
	$app->render('accueil.php');
});

$app->run();
?>