<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

$clientes = new Clientes();

Usuarios::verificarLogin();

$resultados = Clientes::listarCliAlt();

if (isset($_POST['AlterarCli'])){
	$clientes->updateCli();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Alterar Cliente</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<section class="container">

		<h1 class="center">Alterar Cliente</h1>
		<form class="form" method="post">
			
			<label>Nome do cliente</label>
			<input type="text" name="nome" class="input-text" value="<?= $resultados->nome; ?>" required>

			<label>CPF</label>
			<input type="text" name="cpf" class="input-text" value="<?= $resultados->cpf; ?>" required>

			<label>Telefone</label>
			<input type="password" name="fone" class="input-text" value="<?= $resultados->fone; ?>" required>

			<input type="hidden" name="id" class="input-text" value="<?= $resultados->id; ?>" required>

			<input type="submit" name="AlterarCli" value="Alterar" class="btn-4">

		</form>

	</section>
</body>
</html>