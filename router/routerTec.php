<?php

include_once PATH . '/src/Controller/TecnicoController.php';
include_once PATH . '/src/Model/Tecnico.php';

$app->get('/tecnicos', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $tec = new TecnicoController();
        $res = $tec->listar();

        return $this->view->render($response, 'tecnicos.html', [
            'tec' => $res
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('tecnicos');

/**
 * 
 * INSERIR TÉCNICO
 * 
 */

$app->get('/novoTecnico', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        return $this->view->render($response, 'novo_tec.html');
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('novoTecnico');

$app->post('/novoTecnico', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');

        $tec = new TecnicoController();
        $tecM = new Tecnico();
        $tecM->setNome($nome);
        $tecM->setCpf($cpf);
        $tec->inserir($tecM);
        
        return $response->withRedirect($this->router->pathFor('tecnicos'));
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('novoTecnico');

/**
 * 
 * ALTERAR TÉCNICO
 * 
 */

$app->get('/alterarTecnico/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $tec = new TecnicoController();
        $res = $tec->listarUnico($args['id']);

        return $this->view->render($response, 'alterar_tec.html', [
            'tec' => $res
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('alterarTecnico');

$app->post('/alterarTecnico/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');

        $tec = new TecnicoController();
        $tecM = new Tecnico();
        $tecM->setNome($nome);
        $tecM->setCpf($cpf);
        $tec->alterar($tecM, $args['id']);
        
        return $response->withRedirect($this->router->pathFor('tecnicos'));
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('alterarTecnico');

/**
 * 
 * DELETAR TÉCNICO
 * 
 */

$app->get('/deletarTecnico/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $tec = new TecnicoController();
        $tec->excluir($args['id']);

        return $response->withRedirect($this->router->pathFor('tecnicos'));
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('deletarTecnico');