<?php

include_once PATH . '/src/Controller/UsuarioController.php';

$app->get('/', function ($request, $response, $args) {
    return $response->withHeader('Location', 'login');
})->setName('index');

$app->get('/login', function ($request, $response, $args) {
    return $this->view->render($response, 'login.html');
})->setName('login');

$app->post('/login', function ($request, $response, $args) {
    
    $login = filter_input(INPUT_POST, 'login');
    $senha = filter_input(INPUT_POST, 'senha');
    
    $user = new UsuarioController();
    $res = $user->login($login, $senha);
    #print_r($res);

    if ($res == true) {
        setcookie('user', $login);
        return $response->withHeader('Location', 'painel');
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('login');

$app->get('/painel', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        return $this->view->render($response, 'painel.html');
    } else {
        return $response->withHeader('Location', 'login');
    }

})->setName('painel');

$app->get('/logout', function ($request, $response, $args) {
    
    setcookie("token", NULL, -1);
    setcookie("user", NULL, -1);
    return $response->withHeader('Location', 'login');

})->setName('logout');