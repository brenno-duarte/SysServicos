<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

$clientes = new Clientes();

if (isset($_POST['CadastrarCli'])){
	$clientes->createCli();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Novo Cliente</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<section class="container">

		<h1 class="center">Novo Cliente</h1>
		<form class="form" method="post">
			
			<label>Nome do cliente</label>
			<input type="text" name="nome" class="input-text" required>

			<label>CPF</label>
			<input type="text" name="cpf" class="input-text" required>

			<label>Telefone</label>
			<input type="text" name="fone" class="input-text" required>

			<input type="submit" name="CadastrarCli" value="Cadastrar" class="btn-4">

		</form>

	</section>
</body>
</html>