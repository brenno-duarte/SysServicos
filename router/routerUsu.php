<?php

include_once PATH . '/src/Controller/UsuarioController.php';
include_once PATH . '/src/Model/Usuario.php';

$app->get('/usuarios', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        
        $user = new UsuarioController();
        $res = $user->listar();
        
        return $this->view->render($response, 'usuarios.html', [
            'user' => $res
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('usuarios');

/**
 * 
 * NOVO USUÁRIO
 * 
 */

$app->get('/novoUsuario', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        return $this->view->render($response, 'novo_usu.html');
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('novoUsuario');

$app->post('/novoUsuario', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $fone = filter_input(INPUT_POST, 'fone');
        $login = filter_input(INPUT_POST, 'login');
        $senha = filter_input(INPUT_POST, 'senha');

        $user = new UsuarioController();
        $userModel = new Usuario();
        
        $userModel->setNome($nome);
        $userModel->setCpf($cpf);
        $userModel->setFone($fone);
        $userModel->setLogin($login);
        $userModel->setSenha($senha);
        $user->inserir($userModel);

        return $response->withHeader('Location', 'usuarios');
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('novoUsuario');

/**
 * 
 * ALTERAR USUÁRIO
 * 
 */

$app->get('/alterarUsuario/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $user = new UsuarioController();
        $res = $user->listarUnico($args['id']);

        return $this->view->render($response, 'alterar_usu.html', [
            'user' => $res
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('alterarUsuario');

$app->post('/alterarUsuario/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $fone = filter_input(INPUT_POST, 'fone');
        $login = filter_input(INPUT_POST, 'login');
        $senha = filter_input(INPUT_POST, 'senha');

        $user = new UsuarioController();
        $userModel = new Usuario();
        
        $userModel->setNome($nome);
        $userModel->setCpf($cpf);
        $userModel->setFone($fone);
        $userModel->setLogin($login);
        $userModel->setSenha($senha);
        $user->alterar($userModel, $args['id']);

        return $response->withRedirect($this->router->pathFor('usuarios'));
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('alterarUsuario');

/**
 * 
 * DELETAR USUÁRIO
 * 
 */

$app->get('/deletarUsuario/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        $user = new UsuarioController();
        $user->excluir($args['id']);

        return $response->withRedirect($this->router->pathFor('usuarios'));
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('deletarUsuario');