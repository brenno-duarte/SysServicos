<?php

include_once PATH . '/src/DAO/UsuarioDAO.php';
include_once PATH . '/src/Model/Usuario.php';

class UsuarioController extends UsuarioDAO {

    public function login($login, $senha){
        $usuarioDAO = new UsuarioDAO();
        $usuario = new Usuario();

        $usuario->setLogin($login);
        $usuario->setSenha($senha);

        $res = $usuarioDAO->validarLogin($usuario);
        return $res;
    }

    public static function listar(){
        $usuarioDAO = new UsuarioDAO();

        $res = $usuarioDAO->listAll();
        return $res;
    }

    public static function listarUnico($id){
        $usuarioDAO = new UsuarioDAO();

        $res = $usuarioDAO->listOnly($id);
        return $res;
    }

    public static function inserir($nome, $cpf, $fone, $login, $senha){
        $usuarioDAO = new UsuarioDAO();
        $userModel = new Usuario();
        $userModel->setNome($nome);
        $userModel->setCpf($cpf);
        $userModel->setFone($fone);
        $userModel->setLogin($login);
        $userModel->setSenha($senha);
        $res = $usuarioDAO->insert($userModel);
        return $res;
    }

    public function alterar($nome, $cpf, $fone, $login, $senha, int $id){
        $usuarioDAO = new UsuarioDAO();
        $userModel = new Usuario();        
        $userModel->setNome($nome);
        $userModel->setCpf($cpf);
        $userModel->setFone($fone);
        $userModel->setLogin($login);
        $userModel->setSenha($senha);

        $res = $usuarioDAO->update($userModel, $id);
        return $res;
    }

    public static function excluir(int $id){
        $usuarioDAO = new UsuarioDAO();

        $res = $usuarioDAO->delete($id);
        return $res;
    }
}