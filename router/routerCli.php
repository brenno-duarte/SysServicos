<?php

include_once PATH . '/src/Controller/ClienteController.php';
include_once PATH . '/src/Model/Cliente.php';

$app->get('/clientes', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $cliente = ClienteController::listar();

        $msg = $this->flash->getFirstMessage('erroFk');
        $msg1 = $this->flash->getFirstMessage('cliAdd');
        $msg2 = $this->flash->getFirstMessage('cliAlt');
        $msg3 = $this->flash->getFirstMessage('cliDel');
        return $this->view->render($response, 'clientes.html', [
            'cli' => $cliente,
            'msg' => $msg,
            'msg1' => $msg1,
            'msg2' => $msg2,
            'msg3' => $msg3
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('clientes');

/**
 * 
 * INSERIR CLIENTE
 * 
 */

$app->get('/novoCliente', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        return $this->view->render($response, 'novo_cli.html');
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('novoCliente');

$app->post('/novoCliente', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $fone = filter_input(INPUT_POST, 'fone');

        ClienteController::inserir($nome, $cpf, $fone);
        $this->flash->addMessage('cliAdd', 'Cliente cadastrado com sucesso');
        return $response->withHeader('Location', 'clientes');
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('novoCliente');

/**
 * 
 * ALTERAR CLIENTE
 * 
 */

$app->get('/alterarCliente/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $cliente = new ClienteController();
        $res = $cliente->listarUnico($args['id']);

        return $this->view->render($response, 'alterar_cli.html', [
            'cli' => $res
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('alterarCliente');

$app->post('/alterarCliente/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $fone = filter_input(INPUT_POST, 'fone');

        ClienteController::alterar($nome, $cpf, $fone, $args['id']);
        $this->flash->addMessage('cliAlt', 'Cliente alterado com sucesso');
        return $response->withRedirect($this->router->pathFor('clientes'));
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('alterarCliente');

/**
 * 
 * DELETAR CLIENTE
 * 
 */

$app->get('/deletarCliente/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $delete = ClienteController::excluir($args['id']);

        if ($delete) {
            $this->flash->addMessage('cliDel', 'Cliente deletado com sucesso');
            return $response->withRedirect($this->router->pathFor('clientes'));
        } else {
            $this->flash->addMessage('erroFk', 'O cliente possui dependências em outro local');
            return $response->withRedirect($this->router->pathFor('clientes'));
        }
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('deletarCliente');

$app->get('/erro', function ($request, $response, $args){
    echo 'erro ao excluir';
})->setName('erro');