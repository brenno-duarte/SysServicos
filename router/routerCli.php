<?php

$app->get('/clientes', function ($request, $response, $args) {
    return $this->view->render($response, 'clientes.html');
})->setName('clientes');

$app->get('/novoCliente', function ($request, $response, $args) {
    return $this->view->render($response, 'novo_cli.html');
})->setName('novoCliente');