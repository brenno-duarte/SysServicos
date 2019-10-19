<?php

include_once PATH . '/src/Controller/OSController.php';
include_once PATH . '/src/Model/Cliente.php';

$app->get('/orcamento', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $os = OSController::listar();

        $msg = $this->flash->getFirstMessage('orcamento');
        $msg1 = $this->flash->getFirstMessage('cliAdd');
        $msg2 = $this->flash->getFirstMessage('cliAlt');
        $msg3 = $this->flash->getFirstMessage('cliDel');
        return $this->view->render($response, 'orcamento.html', [
            'os' => $os,
            'msg' => $msg,
            'msg1' => $msg1,
            'msg2' => $msg2,
            'msg3' => $msg3
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('orcamento');

$app->get('/pesq-orcamento', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $os = OSController::listar();


    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('pesqOrcamento');

$app->get('/fazer-orcamento/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $os = OSController::listarOSOrcamento($args['id']);
        
        return $this->view->render($response, 'fazer-orcamento.html', [
            'os' => $os
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('fazerOrcamento');

$app->post('/finalizar-orcamento/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $pecas = filter_input(INPUT_POST, 'pecas');
        $servico = filter_input(INPUT_POST, 'servico');
        $desconto = filter_input(INPUT_POST, 'desconto');
        
        if (empty($desconto)) {
            $desconto = 0;
        }
        
        $total = ($pecas + $servico) - $desconto;
        $os = OSController::listarOSOrcamento($args['id']);
        
        return $this->view->render($response, 'finalizar-orc.html', [
            'os' => $os,
            'pecas' => $pecas,
            'servico' => $servico,
            'desconto' => $desconto,
            'total' => $total
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('finalizarOrcamento');

$app->post('/finalizar-orcamento-atualizar/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $total = filter_input(INPUT_POST, 'total');
        OSController::alterarTotal($total, $args['id']);
        
        $this->flash->addMessage('orcamento', 'Orçamento gerado');
        return $response->withRedirect($this->router->pathFor('orcamento'));
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('finalizarOrcamentoAlt');