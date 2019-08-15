<?php

$app->get('/tecnicos', function ($request, $response, $args) {
    return $this->view->render($response, 'tecnicos.html');
})->setName('tecnicos');

$app->get('/novoTecnico', function ($request, $response, $args) {
    return $this->view->render($response, 'novo_tec.html');
})->setName('novoTecnico');