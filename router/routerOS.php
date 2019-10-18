<?php

include_once PATH . '/src/Controller/OSController.php';
include_once PATH . '/src/Model/OS.php';

$app->get('/ordemDeServico', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $os = OSController::listar();

        $msg1 = $this->flash->getFirstMessage('osAdd');
        $msg2 = $this->flash->getFirstMessage('osAlt');
        $msg3 = $this->flash->getFirstMessage('osDel');
        return $this->view->render($response, 'os.html', [
            'os' => $os,
            'msg1' => $msg1,
            'msg2' => $msg2,
            'msg3' => $msg3
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('ordemDeServico');

/**
 * 
 * INSERIR OS
 * 
 */

$app->get('/novaOrdemDeServico', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $tec = TecnicoController::listar();
        $cli = ClienteController::listar();

        return $this->view->render($response, 'novo_os.html', [
            'tec' => $tec,
            'cli' => $cli
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }
      
})->setName('novaOrdemDeServico');

$app->post('/novaOrdemDeServico', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $cliente = filter_input(INPUT_POST, 'cliente');
        $tecnico = filter_input(INPUT_POST, 'tecnico');
        $equip = filter_input(INPUT_POST, 'equip');
        $defeito = filter_input(INPUT_POST, 'defeito');
        $situacao = filter_input(INPUT_POST, 'situacao');
        $valor = filter_input(INPUT_POST, 'valor');

        OSController::inserir($cliente, $tecnico, $equip, $defeito, $situacao, $valor);
        $this->flash->addMessage('osAdd', 'Ordem de serviço cadastrado com sucesso');
        return $response->withRedirect($this->router->pathFor('ordemDeServico'));
    } else {
        return $response->withHeader('Location', 'login');
    }
      
})->setName('novaOrdemDeServico');

/**
 * 
 * ALTERAR OS
 * 
 */

$app->get('/alterarOrdemDeServico/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $tec = TecnicoController::listar();  
        $cli = ClienteController::listar();
        $os = OSController::listarUnico($args['id']);

        return $this->view->render($response, 'alterar_os.html', [
            'tec' => $tec,
            'cli' => $cli,
            'os' => $os
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }
      
})->setName('alterarOrdemDeServico');

$app->post('/alterarOrdemDeServico/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $cliente = filter_input(INPUT_POST, 'cliente');
        $tecnico = filter_input(INPUT_POST, 'tecnico');
        $equip = filter_input(INPUT_POST, 'equip');
        $defeito = filter_input(INPUT_POST, 'defeito');
        $situacao = filter_input(INPUT_POST, 'situacao');
        $valor = filter_input(INPUT_POST, 'valor');

        OSController::alterar($cliente, $tecnico, $equip, $defeito, $situacao, $valor, $args['id']);
        $this->flash->addMessage('osAlt', 'Ordem de serviço alterado com sucesso');
        return $response->withRedirect($this->router->pathFor('ordemDeServico'));
    } else {
        return $response->withHeader('Location', 'login');
    }
      
})->setName('alterarOrdemDeServico');

/**
 * 
 * DELETAR OS
 * 
 */

$app->get('/deletarOrdemDeServico/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        OSController::excluir($args['id']);
        $this->flash->addMessage('osDel', 'Ordem de serviço deletado com sucesso');
        return $response->withRedirect($this->router->pathFor('ordemDeServico'));
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('deletarOrdemDeServico');