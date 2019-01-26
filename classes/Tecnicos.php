<?php

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
}); 

class Tecnicos {

	public static function listarTec() {

		$stmt = DB::prepare("SELECT * FROM tb_tecnicos ORDER BY nome");
		$stmt->execute();
		$resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $resultados;
	}

	public static function listarTecAlt() {

		$id = $_GET['id'];
		$stmt = DB::prepare("SELECT * FROM tb_tecnicos WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$resultados = $stmt->fetch(PDO::FETCH_OBJ);
		return $resultados;
	}

	public function createTec() {

		$nome = isset($_POST['nome'])? $_POST['nome'] : NULL;
		$cpf = isset($_POST['cpf'])? $_POST['cpf'] : NULL;
		
		try {
			$stmt = DB::prepare("INSERT INTO tb_tecnicos (nome,cpf) VALUES (:nome,:cpf)");

			$stmt->bindParam(':nome', $nome);
			$stmt->bindParam(':cpf', $cpf);
			$stmt->execute();

			header("location: tecnicos.php");
		} catch (Exception $e) {
			echo $e->getMessage();
		}		
	}

	public function updateTec() {

		$nome = isset($_POST['nome'])? $_POST['nome'] : NULL;
		$cpf = isset($_POST['cpf'])? $_POST['cpf'] : NULL;
		$id = isset($_POST['id'])? $_POST['id'] : NULL;

		try {
			$stmt = DB::prepare("
				UPDATE tb_tecnicos SET 
				nome = :nome,
				cpf = :cpf WHERE id=:id");

			$stmt->bindParam(':nome', $nome);
			$stmt->bindParam(':cpf', $cpf);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			
			header("location: tecnicos.php");
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}

?>