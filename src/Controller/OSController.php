<?php

include_once PATH . '/src/DAO/OSDAO.php';
include_once PATH . '/src/Model/OS.php';

class OSController extends OSDAO {

    public function listar(){
        $OSDAO = new OSDAO();

        $res = $OSDAO->listAll();
        return $res;
    }

    public function listarUnico($id){
        $OSDAO = new OSDAO();

        $res = $OSDAO->listOnly($id);
        return $res;
    }

    public function inserir(OS $os){
        $OSDAO = new OSDAO();

        $res = $OSDAO->insert($os);
        return $res;
    }

    public function alterar(OS $os, int $id){
        $OSDAO = new OSDAO();

        $res = $OSDAO->update($os, $id);
        return $res;
    }

    public function excluir(int $id){
        $OSDAO = new OSDAO();

        $res = $OSDAO->delete($id);
        return $res;
    }
}