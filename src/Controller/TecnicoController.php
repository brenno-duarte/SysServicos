<?php

include_once PATH . '/src/DAO/TecnicoDAO.php';
include_once PATH . '/src/Model/Tecnico.php';

class TecnicoController extends TecnicoDAO {

    public function listar(){
        $tecnicoDAO = new TecnicoDAO();

        $res = $tecnicoDAO->listAll();
        return $res;
    }

    public function listarUnico($id){
        $tecnicoDAO = new TecnicoDAO();

        $res = $tecnicoDAO->listOnly($id);
        return $res;
    }

    public function inserir(Tecnico $tecnico){
        $tecnicoDAO = new TecnicoDAO();

        $res = $tecnicoDAO->insert($tecnico);
        return $res;
    }

    public function alterar(Tecnico $tecnico, int $id){
        $tecnicoDAO = new TecnicoDAO();

        $res = $tecnicoDAO->update($tecnico, $id);
        return $res;
    }

    public function excluir(int $id){
        $tecnicoDAO = new TecnicoDAO();

        $res = $tecnicoDAO->delete($id);
        return $res;
    }
}