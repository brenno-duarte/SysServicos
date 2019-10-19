<?php

$app->get('/painel', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $cli = ClienteController::totalCli();
        $os = OSController::OSPendente();
        $osTotal = OSController::listar();
        $count = count($osTotal);
        
        return $this->view->render($response, 'painel.html', [
            'cli' => $cli[0],
            'os' => $os,
            'osTotal' => $count
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('painel');