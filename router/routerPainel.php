<?php

$app->get('/painel', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $cli = ClienteController::totalCli();
        $os = OSController::OSPendente();
        
        return $this->view->render($response, 'painel.html', [
            'cli' => $cli[0],
            'os' => $os
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('painel');