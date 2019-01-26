<?php

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

class OS {

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

	public static function listarOSAlt() {

		$id = $_GET['id'];
		$stmt = DB::prepare("SELECT * FROM tb_os WHERE idOS=:id");
		$stmt->execute(['id'=>$id]);
		$resultados = $stmt->fetch(PDO::FETCH_OBJ);
		return $resultados;
	}

	public static function listarOSOrc() {

		$id = $_GET['id'];
		$stmt = DB::prepare("SELECT * FROM tb_os a INNER JOIN tb_clientes b ON b.id=a.idCli WHERE idOS=:id ORDER BY b.nome");
		$stmt->execute(['id'=>$id]);
		$resultados = $stmt->fetch(PDO::FETCH_OBJ);
		return $resultados;
	}

	public static function orcamento()
	{
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

				header("location: os.php");
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
	
	public function createOS()
	{

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

	public function updateOS()
	{

		$nome = isset($_POST['nome']) ? $_POST['nome'] : NULL;
		$situacao = isset($_POST['situacao']) ? $_POST['situacao'] : NULL;
		$equip = isset($_POST['equip']) ? $_POST['equip'] : NULL;
		$defeito = isset($_POST['defeito']) ? $_POST['defeito'] : NULL;
		$tecnico = isset($_POST['tecnico']) ? $_POST['tecnico'] : NULL;
		$valor = isset($_POST['valor']) ? $_POST['valor'] : NULL;
		$id = isset($_POST['id']) ? $_POST['id'] : NULL;

		try {
			$stmt = DB::prepare("UPDATE tb_os SET idCli=?,situacao=?,equip=?,defeito=?,tecnico=?,valor=? WHERE id=?");
			
			$stmt->bindParam(1, $nome);
			$stmt->bindParam(2, $situacao);
			$stmt->bindParam(3, $equip);
			$stmt->bindParam(4, $defeito);
			$stmt->bindParam(5, $tecnico);
			$stmt->bindParam(6, $valor);
			$stmt->bindParam(7, $id);
			$stmt->execute();

			header("location: os.php");
		} catch (Exception $e) {
			echo $e->getMessage();			
		}
	}
}

?>