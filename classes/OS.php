<?php

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

class OS extends SQL {

    protected $table = 'tb_os';
    private $idCli;
    private $situacao;
    private $equip;
    private $defeito;
    private $tecnico;

    public function getIdCli() {
        return $this->idCli;
    }

    public function setIdCli($idCli) {
        $this->idCli = $idCli;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    public function getEquip() {
        return $this->equip;
    }

    public function setEquip($equip) {
        $this->equip = $equip;
    }

    public function getDefeito() {
        return $this->defeito;
    }

    public function setDefeito($defeito) {
        $this->defeito = $defeito;
    }

    public function getTecnico() {
        return $this->tecnico;
    }

    public function setTecnico($tecnico) {
        $this->tecnico = $tecnico;
    }

    public static function listarOS() {

        $stmt = DB::prepare("SELECT * FROM tb_clientes a INNER JOIN tb_os b ON a.id=b.idCli ORDER BY a.nome");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $resultados;
    }

    public static function listarOS2() {

        $stmt = DB::prepare("SELECT * FROM tb_os b INNER JOIN tb_clientes a ON a.id=b.idCli WHERE situacao LIKE 'Aguardando autorização' ORDER BY a.nome");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $resultados;
    }

    public static function listarOS3() {

        $stmt = DB::prepare("SELECT * FROM tb_os_final a INNER JOIN tb_os b ON a.idOS=b.id");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $resultados;
    }

    public function listarOSOrc($id) {

        $sql = "SELECT a.id, b.nome, a.situacao, a.equip FROM $this->table a INNER JOIN tb_clientes b ON a.idCli=b.id WHERE a.id=:id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function orcamentoTotal($id, $total) {

        try {
            $stmt = DB::prepare("UPDATE $this->table SET valor=:valor,situacao='Aguardando autorização' WHERE id=:id");

            $stmt->bindParam(':valor', $total);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            //header("location: painel.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function orcamentoD($id, $totalD) {
        
        try {
            $sql = "UPDATE $this->table SET valor=:valor WHERE id=:id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':valor', $totalD);
            $stmt->bindParam(':id', $id);
            
            /*var_dump($id);
            var_dump($totalD);*/
            $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insert() {

        try {
            $sql = "INSERT INTO $this->table (idCli, situacao, equip, defeito, tecnico) VALUES (:idCli, :situacao, :equip, :defeito, :tecnico)";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':idCli', $this->idCli);
            $stmt->bindParam(':situacao', $this->situacao);
            $stmt->bindParam(':equip', $this->equip);
            $stmt->bindParam(':defeito', $this->defeito);
            $stmt->bindParam(':tecnico', $this->tecnico);

            /* var_dump($this->idCli);
              var_dump($this->situacao);
              var_dump($this->equip);
              var_dump($this->defeito);
              var_dump($this->tecnico); */

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update($id) {

        try {
            $sql = "UPDATE $this->table SET idCli=:idCli, situacao=:situacao, equip=:equip, defeito=:defeito, tecnico=:tecnico WHERE id=:id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':idCli', $this->idCli);
            $stmt->bindParam(':situacao', $this->situacao);
            $stmt->bindParam(':equip', $this->equip);
            $stmt->bindParam(':defeito', $this->defeito);
            $stmt->bindParam(':tecnico', $this->tecnico);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
