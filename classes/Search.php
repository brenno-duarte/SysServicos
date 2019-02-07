<?php

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

class Search {
	
	public static function pesqCli() {

		$search = isset($_GET['search']) ? $_GET['search'] : '';  

		$stmt = DB::prepare("SELECT * FROM tb_os a INNER JOIN tb_clientes b ON a.idCli=b.id WHERE b.nome LIKE :search");
		$stmt->bindValue(':search', '%' . $search . '%');
		$stmt->execute();

		return $clientes = $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}

?>