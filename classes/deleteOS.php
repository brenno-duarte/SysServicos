<?php

session_start();

spl_autoload_register(function($class){
	include $class . '.php';
});

$id = $_GET['id'];

try {
	$stmt = DB::prepare("DELETE FROM tb_os WHERE idOS=:id");
	$stmt->bindParam(':id', $id);
	$r = $stmt->execute();

	return header("location: ../os.php");
} catch (Exception $e) {
	echo $e->getMessage();
}