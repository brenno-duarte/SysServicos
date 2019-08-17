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

    public function listar(){
        $usuarioDAO = new UsuarioDAO();

        $res = $usuarioDAO->listAll();
        return $res;
    }

    public function listarUnico($id){
        $usuarioDAO = new UsuarioDAO();

        $res = $usuarioDAO->listOnly($id);
        return $res;
    }

    public function inserir(Usuario $usuario){
        $usuarioDAO = new UsuarioDAO();

        $res = $usuarioDAO->insert($usuario);
        return $res;
    }

    public function alterar(Usuario $usuario, int $id){
        $usuarioDAO = new UsuarioDAO();

        $res = $usuarioDAO->update($usuario, $id);
        return $res;
    }

    public function excluir(int $id){
        $usuarioDAO = new UsuarioDAO();

        $res = $usuarioDAO->delete($id);
        return $res;
    }
}