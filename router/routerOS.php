<?php

$app->get('/ordemDeServico', function ($request, $response, $args) {
    return $this->view->render($response, 'os.html');
})->setName('ordemDeServico');

$app->get('/novaOrdemDeServico', function ($request, $response, $args) {
    return $this->view->render($response, 'novo_os.html');
})->setName('novaOrdemDeServico');