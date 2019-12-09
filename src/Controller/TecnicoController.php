<?php

include_once PATH . '/src/DAO/TecnicoDAO.php';
include_once PATH . '/src/Model/Tecnico.php';

class TecnicoController extends TecnicoDAO {

    public static function listar(){
        $tecnicoDAO = new TecnicoDAO();

        $res = $tecnicoDAO->listAll();
        return $res;
    }

    public static function listarUnico($id){
        $tecnicoDAO = new TecnicoDAO();

        $res = $tecnicoDAO->listOnly($id);
        return $res;
    }

    public static function inserir($nome, $cpf, $fone){
        $tecnicoDAO = new TecnicoDAO();
        $tecM = new Tecnico();
        $tecM->setNome($nome);
        $tecM->setCpf($cpf);
        $tecM->setFone($fone);
        $res = $tecnicoDAO->insert($tecM);
        return $res;
    }

    public static function alterar($nome, $cpf, $fone, int $id){
        $tecnicoDAO = new TecnicoDAO();
        $tecM = new Tecnico();
        $tecM->setNome($nome);
        $tecM->setCpf($cpf);
        $tecM->setFone($fone);
        $res = $tecnicoDAO->update($tecM, $id);
        return $res;
    }

    public static function excluir(int $id){
        $tecnicoDAO = new TecnicoDAO();

        $res = $tecnicoDAO->delete($id);
        return $res;
    }
}