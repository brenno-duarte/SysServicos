<?php

require_once("DB.php");

class OS {

	public static function listarOS() {

		$con = DB::Conectar();

		$stmt = $con->prepare("SELECT * FROM tb_clientes a INNER JOIN tb_os b ON a.id=b.idCli;");
		$stmt->execute();
		$resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $resultados;
	}

	public static function listarOSAlt() {

		$con = DB::Conectar();

		$id = $_GET['id'];
		$stmt = $con->prepare("SELECT * FROM tb_os WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$resultados = $stmt->fetch(PDO::FETCH_OBJ);
		return $resultados;
	}
	
	public function createOS()
	{
		$con = DB::Conectar();

		$nome = isset($_POST['nome']) ? $_POST['nome'] : NULL;
		$situacao = isset($_POST['situacao']) ? $_POST['situacao'] : NULL;
		$equip = isset($_POST['equip']) ? $_POST['equip'] : NULL;
		$defeito = isset($_POST['defeito']) ? $_POST['defeito'] : NULL;
		$tecnico = isset($_POST['tecnico']) ? $_POST['tecnico'] : NULL;
		$valor = isset($_POST['valor']) ? $_POST['valor'] : NULL;
		$dataOs = isset($_POST['dataOs']) ? $_POST['dataOs'] : NULL;

		try {
			$stmt = $con->prepare("INSERT INTO tb_os (idCli, situacao,equip,defeito,tecnico,valor,dataOs) VALUES (?,?,?,?,?,?,?)");
			
			$stmt->bindParam(1, $nome);
			$stmt->bindParam(2, $situacao);
			$stmt->bindParam(3, $equip);
			$stmt->bindParam(4, $defeito);
			$stmt->bindParam(5, $tecnico);
			$stmt->bindParam(6, $valor);
			$stmt->bindParam(7, $dataOs);
			$stmt->execute();

			header("location: os.php");
		} catch (Exception $e) {
			echo $e->getMessage();			
		}
	}

	public function updateOS()
	{
		$con = DB::Conectar();

		$nome = isset($_POST['nome']) ? $_POST['nome'] : NULL;
		$situacao = isset($_POST['situacao']) ? $_POST['situacao'] : NULL;
		$equip = isset($_POST['equip']) ? $_POST['equip'] : NULL;
		$defeito = isset($_POST['defeito']) ? $_POST['defeito'] : NULL;
		$tecnico = isset($_POST['tecnico']) ? $_POST['tecnico'] : NULL;
		$valor = isset($_POST['valor']) ? $_POST['valor'] : NULL;
		$dataOs = isset($_POST['dataOs']) ? $_POST['dataOs'] : NULL;
		$id = isset($_POST['id']) ? $_POST['id'] : NULL;

		try {
			$stmt = $con->prepare("UPDATE tb_os SET idCli=?,situacao=?,equip=?,defeito=?,tecnico=?,valor=?,dataOs=? WHERE id=?");
			
			$stmt->bindParam(1, $nome);
			$stmt->bindParam(2, $situacao);
			$stmt->bindParam(3, $equip);
			$stmt->bindParam(4, $defeito);
			$stmt->bindParam(5, $tecnico);
			$stmt->bindParam(6, $valor);
			$stmt->bindParam(7, $dataOs);
			$stmt->bindParam(8, $id);
			$stmt->execute();

			header("location: os.php");
		} catch (Exception $e) {
			echo $e->getMessage();			
		}
	}
}

?>