<?php

include_once PATH . '/src/Controller/OSController.php';
include_once PATH . '/src/Model/OS.php';

$app->get('/ordemDeServico', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $os = new OSController();
        $res = $os->listar();

        return $this->view->render($response, 'os.html', [
            'os' => $res
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

        $tecnico = new TecnicoController();  
        $cliente = new ClienteController();
        $cli = $cliente->listar();
        $tec = $tecnico->listar();

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

        $os = new OSController();
        $osModel = new OS();
        $osModel->setIdCli($cliente);
        $osModel->setTecnico($tecnico);
        $osModel->setEquip($equip);
        $osModel->setDefeito($defeito);
        $osModel->setSituacao($situacao);
        $osModel->setValor($valor);
        $os->inserir($osModel);

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

        $tecnico = new TecnicoController();  
        $cliente = new ClienteController();
        $ordem = new OSController();
        $cli = $cliente->listar();
        $tec = $tecnico->listar();
        $os = $ordem->listarUnico($args['id']);

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

        $os = new OSController();
        $osModel = new OS();
        $osModel->setIdCli($cliente);
        $osModel->setTecnico($tecnico);
        $osModel->setEquip($equip);
        $osModel->setDefeito($defeito);
        $osModel->setSituacao($situacao);
        $osModel->setValor($valor);
        $os->alterar($osModel, $args['id']);

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

        $os = new OSController();
        $os->excluir($args['id']);

        return $response->withRedirect($this->router->pathFor('ordemDeServico'));
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('deletarOrdemDeServico');