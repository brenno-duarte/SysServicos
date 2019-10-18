<?php

include_once PATH . '/src/DAO/ClienteDAO.php';
include_once PATH . '/src/Model/Cliente.php';

class ClienteController extends ClienteDAO {

    public static function listar(){
        $usuarioDAO = new ClienteDAO();

        $res = $usuarioDAO->listAll();
        return $res;
    }

    public function totalCli(){
        $usuarioDAO = new ClienteDAO();

        $res = $usuarioDAO->countCliente();
        return $res;
    }

    public function listarUnico($id){
        $clienteDAO = new ClienteDAO();

        $res = $clienteDAO->listOnly($id);
        return $res;
    }

    public static function inserir($nome, $cpf, $fone){
        $clienteDAO = new ClienteDAO();
        $cliente = new Cliente();
        $cliente->setNome($nome);
        $cliente->setCpf($cpf);
        $cliente->setFone($fone);
        $res = $clienteDAO->insert($cliente);
        return $res;
    }

    public static function alterar($nome, $cpf, $fone, int $id){
        $clienteDAO = new ClienteDAO();
        $cliente = new Cliente();
        $cliente->setNome($nome);
        $cliente->setCpf($cpf);
        $cliente->setFone($fone);
        $res = $clienteDAO->update($cliente, $id);
        return $res;
    }

    public static function excluir(int $id){
        $clienteDAO = new ClienteDAO();

        $res = $clienteDAO->delete($id);
        return $res;
    }
}