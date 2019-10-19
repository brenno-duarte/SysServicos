<?php

include_once PATH . '/src/Controller/UsuarioController.php';
include_once PATH . '/src/Model/Usuario.php';

$app->get('/usuarios', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $user = UsuarioController::listar();
        
        $msg1 = $this->flash->getFirstMessage('usuAdd');
        $msg2 = $this->flash->getFirstMessage('usuAlt');
        $msg3 = $this->flash->getFirstMessage('usuDel');
        return $this->view->render($response, 'usuarios.html', [
            'user' => $user,
            'msg1' => $msg1,
            'msg2' => $msg2,
            'msg3' => $msg3
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

$app->get('/novo-usuario', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        return $this->view->render($response, 'novo_usu.html');
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('novoUsuario');

$app->post('/novo-usuario', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $fone = filter_input(INPUT_POST, 'fone');
        $login = filter_input(INPUT_POST, 'login');
        $senha = filter_input(INPUT_POST, 'senha');

        UsuarioController::inserir($nome, $cpf, $fone, $login, $senha);
        $this->flash->addMessage('usuAdd', 'Usuário cadastrado com sucesso');
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

$app->get('/alterar-usuario/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $res = UsuarioController::listarUnico($args['id']);

        return $this->view->render($response, 'alterar_usu.html', [
            'user' => $res
        ]);
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('alterarUsuario');

$app->post('/alterar-usuario/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $fone = filter_input(INPUT_POST, 'fone');
        $login = filter_input(INPUT_POST, 'login');
        $senha = filter_input(INPUT_POST, 'senha');

        UsuarioController::alterar($nome, $cpf, $fone, $login, $senha, $args['id']);
        $this->flash->addMessage('usuAlt', 'Usuário alterado com sucesso');
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

$app->get('/deletar-usuario/{id}', function ($request, $response, $args) {
    
    if ($_COOKIE['user']) {

        UsuarioController::excluir($args['id']);
        $this->flash->addMessage('usuDel', 'Usuário deletado com sucesso');
        return $response->withRedirect($this->router->pathFor('usuarios'));
    } else {
        return $response->withHeader('Location', 'login');
    }
    
})->setName('deletarUsuario');