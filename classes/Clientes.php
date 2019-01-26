<?php

require_once("DB.php");

class Clientes {

	public static function listarCli() {

		$con = DB::Conectar();

		$stmt = $con->prepare("SELECT * FROM tb_clientes ORDER BY nome");
		$stmt->execute();
		$resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $resultados;
	}

	public static function listarCliAlt() {

		$con = DB::Conectar();

		$id = $_GET['id'];
		$stmt = $con->prepare("SELECT * FROM tb_clientes WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$resultados = $stmt->fetch(PDO::FETCH_OBJ);
		return $resultados;
	}
	
	public function createCli() {

		$con = DB::Conectar();

		$nome = isset($_POST['nome']) ? $_POST['nome'] : NULL;
		$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : NULL;
		$fone = isset($_POST['fone']) ? $_POST['fone'] : NULL;

		try {
			$stmt = $con->prepare("INSERT INTO tb_clientes (nome,cpf,fone) VALUES (:nome,:cpf,:fone)");
			$stmt->bindParam(':nome', $nome);
			$stmt->bindParam(':cpf', $cpf);
			$stmt->bindParam(':fone', $fone);
			$stmt->execute();

			header("location: clientes.php");
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function updateCli() {

		$con = DB::Conectar();

		$nome = isset($_POST['nome']) ? $_POST['nome'] : NULL;
		$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : NULL;
		$fone = isset($_POST['fone']) ? $_POST['fone'] : NULL;
		$id = isset($_POST['id']) ? $_POST['id'] : NULL;

		try {
			$stmt = $con->prepare("UPDATE tb_clientes SET nome = :nome,cpf = :cpf,fone = :fone WHERE id = :id");
			$stmt->bindParam(':nome', $nome);
			$stmt->bindParam(':cpf', $cpf);
			$stmt->bindParam(':fone', $fone);
			$stmt->bindParam(':id', $id);
			$stmt->execute();

			header("location: clientes.php");
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function deleteCli() {
		$con = DB::Conectar();

		$id = $_GET['id'];

		try {
			$stmt = $con->prepare("DELETE FROM tb_clientes WHERE id=:id");
			$stmt->execute(['id'=>$id]);

			header("location: clientes.php");
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}

?>