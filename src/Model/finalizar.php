<?php

session_start();

spl_autoload_register(function($class){
	include $class . '.php';
});

$id = $_GET['id'];
//var_dump($id);

try {
	$stmt = DB::prepare("INSERT INTO tb_os_final (idOS) VALUES (?)");
	$stmt->bindParam(1, $id);
	$stmt->execute();

	return header("location: ../painel.php");
} catch (Exception $e) {
	echo $e->getMessage();
	
}

?>