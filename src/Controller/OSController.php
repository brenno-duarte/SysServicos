<?php

include_once PATH . '/src/DAO/OSDAO.php';
include_once PATH . '/src/Model/OS.php';

class OSController extends OSDAO {

    public static function listar(){
        $OSDAO = new OSDAO();

        $res = $OSDAO->listAll();
        return $res;
    }

    public static function listarUnico($id){
        $OSDAO = new OSDAO();

        $res = $OSDAO->listOnly($id);
        return $res;
    }

    public static function inserir($cliente, $tecnico, $equip, $defeito, $situacao, $valor){
        $OSDAO = new OSDAO();
        $osModel = new OS();
        $osModel->setIdCli($cliente);
        $osModel->setTecnico($tecnico);
        $osModel->setEquip($equip);
        $osModel->setDefeito($defeito);
        $osModel->setSituacao($situacao);
        $osModel->setValor($valor);
        $res = $OSDAO->insert($osModel);
        return $res;
    }

    public static function alterar($cliente, $tecnico, $equip, $defeito, $situacao, $valor, int $id){
        $OSDAO = new OSDAO();
        $osModel = new OS();
        $osModel->setIdCli($cliente);
        $osModel->setTecnico($tecnico);
        $osModel->setEquip($equip);
        $osModel->setDefeito($defeito);
        $osModel->setSituacao($situacao);
        $osModel->setValor($valor);
        $res = $OSDAO->update($osModel, $id);
        return $res;
    }

    public static function excluir(int $id){
        $OSDAO = new OSDAO();

        $res = $OSDAO->delete($id);
        return $res;
    }
}