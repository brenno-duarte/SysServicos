<?php

class OSDAO {

    public function listAll() {
        $sql = "SELECT * FROM tb_os a INNER JOIN tb_clientes b ON a.idCli=b.idCli ORDER BY b.nomeCli";

        $stmt = DB::query($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function listOnly(int $id) {
        $sql = "SELECT * FROM tb_os a INNER JOIN tb_clientes b 
        INNER JOIN tb_tecnicos c ON a.idCli=b.idCli AND a.tecnico=c.idTec WHERE a.idOS = $id";

        $stmt = DB::query($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res;
    }

    public function OSOrcamento(int $id) {
        $sql = "SELECT * FROM tb_os a INNER JOIN tb_clientes b 
        ON a.idCli=b.idCli WHERE a.idOS = $id";
        
        $stmt = DB::query($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function listarOSPendente() {
        $sql = "SELECT * FROM tb_os b INNER JOIN tb_clientes a ON a.idCli=b.idCli 
        WHERE situacao LIKE 'Aguardando diagnóstico' ORDER BY a.nomeCli";

        $stmt = DB::query($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $resultados;
    }

    /*public static function listarOS3() {
        $sql = "SELECT * FROM tb_os_final a INNER JOIN tb_os b ON a.idOS=b.id";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $resultados;
    }

    public function orcamentoTotal($id, $total) {

        try {
            $sql = "UPDATE tb_os SET 
            valor = :valor,
            situacao = 'Aguardando autorização' 
            WHERE id=:id";

            $stmt = DB::prepare($sql);
            $stmt->bindParam(':valor', $total);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function orcamentoD($id, $totalD) {
        
        try {
            $sql = "UPDATE tb_os SET valor=:valor WHERE id=:id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':valor', $totalD);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }*/

    public function insert(OS $os) {

        try {
            $sql = "INSERT INTO tb_os (idCli, situacao, equip, defeito, tecnico, valor) 
            VALUES (:idCli, :situacao, :equip, :defeito, :tecnico, :valor)";

            $stmt = DB::prepare($sql);
            $stmt->bindValue(':idCli', $os->getIdCli());
            $stmt->bindValue(':situacao', $os->getSituacao());
            $stmt->bindValue(':equip', $os->getEquip());
            $stmt->bindValue(':defeito', $os->getDefeito());
            $stmt->bindValue(':tecnico', $os->getTecnico());
            $stmt->bindValue(':valor', $os->getValor());
            $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(OS $os, int $id) {

        try {
            $sql = "UPDATE tb_os SET 
            idCli = :idCli,
            situacao = :situacao, 
            equip = :equip, 
            defeito = :defeito, 
            tecnico = :tecnico,
            valor = :valor 
            WHERE idOS = $id";

            $stmt = DB::prepare($sql);
            $stmt->bindValue(':idCli', $os->getIdCli());
            $stmt->bindValue(':situacao', $os->getSituacao());
            $stmt->bindValue(':equip', $os->getEquip());
            $stmt->bindValue(':defeito', $os->getDefeito());
            $stmt->bindValue(':tecnico', $os->getTecnico());
            $stmt->bindValue(':valor', $os->getValor());
            $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateTotal(OS $os, int $id) {

        try {
            $sql = "UPDATE tb_os SET
            situacao = :situacao,  
            total = :total 
            WHERE idOS = $id";

            $stmt = DB::prepare($sql);
            $stmt->bindValue(':situacao', $os->getSituacao());
            $stmt->bindValue(':total', $os->getTotal());
            $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete(int $id) {
        try {
            $sql = "DELETE FROM tb_os WHERE idOS = $id";
            $stmt = DB::prepare($sql);
            return $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}