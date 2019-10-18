<?php

include_once PATH . '/src/Controller/UsuarioController.php';

$app->get('/', function ($request, $response, $args) {
    return $response->withHeader('Location', 'login');
})->setName('index');

$app->get('/login', function ($request, $response, $args) {

    $msg = $this->flash->getFirstMessage('erroLogin');
    return $this->view->render($response, 'login.html', [
        'msg' => $msg
    ]);
})->setName('login');

$app->post('/login', function ($request, $response, $args) {
    
    $login = filter_input(INPUT_POST, 'login');
    $senha = filter_input(INPUT_POST, 'senha');
    
    $user = new UsuarioController();
    $res = $user->login($login, $senha);

    if ($res == true) {
        setcookie('user', $login);
        return $response->withHeader('Location', 'painel');
    } else {
        $this->flash->addMessage('erroLogin', 'Login e/ou senha inválido');
        return $response->withHeader('Location', 'login');
    }

})->setName('login');

$app->get('/painel', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $cliente = new ClienteController();
        $cli = $cliente->totalCli();
        return $this->view->render($response, 'painel.html', [
            'cli' => $cli
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('painel');

$app->get('/logout', function ($request, $response, $args) {
    
    setcookie("token", NULL, -1);
    setcookie("user", NULL, -1);
    return $response->withHeader('Location', 'login');

})->setName('logout');