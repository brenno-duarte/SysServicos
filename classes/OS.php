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

    public static function listarOSOrc() {

        $id = $_GET['id'];
        $stmt = DB::prepare("SELECT * FROM tb_os a INNER JOIN tb_clientes b ON b.id=a.idCli WHERE idOS=:id ORDER BY b.nome");
        $stmt->execute(['id' => $id]);
        $resultados = $stmt->fetch(PDO::FETCH_OBJ);
        return $resultados;
    }

    public static function orcamento() {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $valorp = isset($_POST['valorp']) ? $_POST['valorp'] : null;
        $valors = isset($_POST['valors']) ? $_POST['valors'] : null;
        $desconto = isset($_POST['desconto']) ? $_POST['desconto'] : null;

        $total = $valorp + $valors;
        $totalD = ($valorp + $valors) - $desconto;

        if (isset($totalD)) {
            try {
                $stmt = DB::prepare("UPDATE tb_os SET valor=?,situacao='Aguardando autorização' WHERE idOS=?");

                $stmt->bindParam(1, $totalD);
                $stmt->bindParam(2, $id);
                $stmt->execute();

                header("location: painel.php");
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } elseif (isset($total)) {
            try {
                $stmt = DB::prepare("UPDATE tb_os SET valor=? WHERE idOS=?");

                $stmt->bindParam(1, $total);
                $stmt->bindParam(2, $id);
                $stmt->execute();

                header("location: os.php");
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function insert() {

        $nome = isset($_POST['nome']) ? $_POST['nome'] : NULL;
        $situacao = isset($_POST['situacao']) ? $_POST['situacao'] : NULL;
        $equip = isset($_POST['equip']) ? $_POST['equip'] : NULL;
        $defeito = isset($_POST['defeito']) ? $_POST['defeito'] : NULL;
        $tecnico = isset($_POST['tecnico']) ? $_POST['tecnico'] : NULL;

        try {
            $stmt = DB::prepare("INSERT INTO tb_os (idCli, situacao,equip,defeito,tecnico) VALUES (?,?,?,?,?)");

            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $situacao);
            $stmt->bindParam(3, $equip);
            $stmt->bindParam(4, $defeito);
            $stmt->bindParam(5, $tecnico);
            $stmt->execute();

            header("location: os.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update($id) {

        try {
            $sql = "UPDATE $this->table SET idCli=?,situacao=?,equip=?,defeito=?,tecnico=?,valor=? WHERE id=?";
            $stmt = DB::prepare($sql);

            $stmt->bindParam(1, $this->nome);
            $stmt->bindParam(2, $this->situacao);
            $stmt->bindParam(3, $this->equip);
            $stmt->bindParam(4, $this->defeito);
            $stmt->bindParam(5, $this->tecnico);
            $stmt->bindParam(6, $this->valor);
            $stmt->bindParam(7, $id);
            $stmt->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}

?>