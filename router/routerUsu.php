<?php

$app->get('/usuarios', function ($request, $response, $args) {
    return $this->view->render($response, 'usuarios.html');
})->setName('usuarios');

$app->get('/novoUsuario', function ($request, $response, $args) {
    return $this->view->render($response, 'novo_usu.html');
})->setName('novoUsuario');