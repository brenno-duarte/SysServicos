<?php

include_once PATH . '/src/Controller/TecnicoController.php';
include_once PATH . '/src/Model/Tecnico.php';

$app->get('/tecnicos', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $tec = TecnicoController::listar();
        
        $msg1 = $this->flash->getFirstMessage('tecAdd');
        $msg2 = $this->flash->getFirstMessage('tecAlt');
        $msg3 = $this->flash->getFirstMessage('tecDel');
        return $this->view->render($response, 'tecnicos.html', [
            'tec' => $tec,
            'msg1' => $msg1,
            'msg2' => $msg2,
            'msg3' => $msg3
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

$app->get('/novo-tecnico', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        return $this->view->render($response, 'novo_tec.html');
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('novoTecnico');

$app->post('/novo-tecnico', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');

        TecnicoController::inserir($nome, $cpf);
        $this->flash->addMessage('tecAdd', 'Técnico cadastrado com sucesso');
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

$app->get('/alterar-tecnico/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $res = TecnicoController::listarUnico($args['id']);

        return $this->view->render($response, 'alterar_tec.html', [
            'tec' => $res
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('alterarTecnico');

$app->post('/alterar-tecnico/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');

        TecnicoController::alterar($nome, $cpf, $args['id']);
        $this->flash->addMessage('tecAlt', 'Técnico alterado com sucesso');
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

$app->get('/deletar-tecnico/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        TecnicoController::excluir($args['id']);
        $this->flash->addMessage('tecDel', 'Técnico deletado com sucesso');
        return $response->withRedirect($this->router->pathFor('tecnicos'));
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('deletarTecnico');