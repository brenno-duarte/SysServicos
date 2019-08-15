<?php

error_reporting(E_ALL);
ini_set("display_errors", true);

require 'vendor/autoload.php';
require 'dependences.php';
require 'router/routerUsu.php';
require 'router/routerCli.php';
require 'router/routerTec.php';
require 'router/routerOS.php';

$app->get('/', function ($request, $response, $args) {
    return $response->withHeader('Location', 'login');
})->setName('index');

$app->get('/login', function ($request, $response, $args) {
    return $this->view->render($response, 'login.html');
})->setName('login');

$app->get('/painel', function ($request, $response, $args) {
    return $this->view->render($response, 'painel.html');
})->setName('painel');

$app->run();