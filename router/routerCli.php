<?php

include_once PATH . '/src/Controller/ClienteController.php';
include_once PATH . '/src/Model/Cliente.php';

$app->get('/clientes', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $cliente = new ClienteController();
        $res = $cliente->listar();

        $msg = $this->flash->getFirstMessage('erroFk');

        return $this->view->render($response, 'clientes.html', [
            'cli' => $res,
            'msg' => $msg
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

        $clienteC = new ClienteController();
        $cliente = new Cliente();
        $cliente->setNome($nome);
        $cliente->setCpf($cpf);
        $cliente->setFone($fone);

        $clienteC->inserir($cliente);

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

        $clienteC = new ClienteController();
        $cliente = new Cliente();
        $cliente->setNome($nome);
        $cliente->setCpf($cpf);
        $cliente->setFone($fone);

        $clienteC->alterar($cliente, $args['id']);

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

        $cliente = new ClienteController();
        $delete = $cliente->excluir($args['id']);

        if ($delete) {
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