<?php

include_once PATH . '/src/DAO/ClienteDAO.php';
include_once PATH . '/src/Model/Cliente.php';

class ClienteController extends ClienteDAO {

    public function listar(){
        $usuarioDAO = new ClienteDAO();

        $res = $usuarioDAO->listAll();
        return $res;
    }

    public function listarUnico($id){
        $clienteDAO = new ClienteDAO();

        $res = $clienteDAO->listOnly($id);
        return $res;
    }

    public function inserir(Cliente $cliente){
        $clienteDAO = new ClienteDAO();

        $res = $clienteDAO->insert($cliente);
        return $res;
    }

    public function alterar(Cliente $cliente, int $id){
        $clienteDAO = new ClienteDAO();

        $res = $clienteDAO->update($cliente, $id);
        return $res;
    }

    public function excluir(int $id){
        $clienteDAO = new ClienteDAO();

        $res = $clienteDAO->delete($id);
        return $res;
    }
}