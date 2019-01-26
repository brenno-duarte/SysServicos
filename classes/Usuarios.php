<?php

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
}); 

class Usuarios {

	public function validarLogin() {

		$login = $_POST['login'];
		$senha = $_POST['senha'];

		try {
			$sql = "SELECT * FROM tb_usuarios WHERE login=:login AND senha=:senha";
			$stmt = DB::prepare($sql);
			$stmt->execute([
				':login' => $login,
				':senha' => $senha
			]);
			$valor = $stmt->rowCount();

			if ($valor > 0) {
				$_SESSION['login'] = $_POST['login'];
				header("location: painel.php");
			} else {
				$_SESSION['error'] = "Login e/ou senha inválido";
				header("location: index.php");
			}
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function verificarLogin()
	{
		if (!isset($_SESSION['login'])) {
			header("location: index.php");
		}
	}

	public static function listarUsu() {

		$stmt = DB::prepare("SELECT * FROM tb_usuarios ORDER BY nome");
		$stmt->execute();
		$resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $resultados;
	}

	public static function listarUsuAlt() {

		$id = $_GET['id'];
		$stmt = DB::prepare("SELECT * FROM tb_usuarios WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$resultados = $stmt->fetch(PDO::FETCH_OBJ);
		return $resultados;
	}

	public function createUsu() {

		$nome = isset($_POST['nome'])? $_POST['nome'] : NULL;
		$cpf = isset($_POST['cpf'])? $_POST['cpf'] : NULL;
		$fone = isset($_POST['fone'])? $_POST['fone'] : NULL;
		$login = isset($_POST['login'])? $_POST['login'] : NULL;
		$senha = isset($_POST['senha'])? $_POST['senha'] : NULL;

		
		if ($_POST['senha'] == $_POST['confSenha']) {
			try {
				$stmt = DB::prepare("INSERT INTO tb_usuarios (nome,cpf,fone,login,senha) VALUES (:nome,:cpf,:fone,:login,:senha)");

				$stmt->bindParam(':nome', $nome);
				$stmt->bindParam(':cpf', $cpf);
				$stmt->bindParam(':fone', $fone);
				$stmt->bindParam(':login', $login);
				$stmt->bindParam(':senha', $senha);
				$stmt->execute();

				header("location: usuarios.php");
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		} else {
			echo "senhas não batem";
		}
		
	}

	public function updateUsu() {

		$nome = isset($_POST['nome'])? $_POST['nome'] : NULL;
		$cpf = isset($_POST['cpf'])? $_POST['cpf'] : NULL;
		$fone = isset($_POST['fone'])? $_POST['fone'] : NULL;
		$login = isset($_POST['login'])? $_POST['login'] : NULL;
		$senha = isset($_POST['senha'])? $_POST['senha'] : NULL;
		$id = isset($_POST['id'])? $_POST['id'] : NULL;

		try {
			$stmt = DB::prepare("
				UPDATE tb_usuarios SET 
				nome = :nome,
				cpf = :cpf,
				fone = :fone,
				login = :login,
				senha = :senha WHERE id=:id");

			$stmt->bindParam(':nome', $nome);
			$stmt->bindParam(':cpf', $cpf);
			$stmt->bindParam(':fone', $fone);
			$stmt->bindParam(':login', $login);
			$stmt->bindParam(':senha', $senha);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			
			header("location: usuarios.php");
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}

?>