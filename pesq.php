 <?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Garantia/Saída de equipamento</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<section class="container">

		<form action="search.php" class="form">
			<legend>Garantia/Saída de equipamento</legend>

			<label for="search">Pesquisar cliente: </label>
			<input type="text" name="search" id="search" placeholder="Busca..." class="input-text">

			<input type="submit" value="Buscar" class="btn-1">
		</form>
	</section>

</body>
</html>