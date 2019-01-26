<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();
$resultados = Tecnicos::listarTecAlt();

$tecnicos = new Tecnicos();

if (isset($_POST['AlterarTec'])){
	$tecnicos->updateTec();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Alterar Técnico</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<section class="container">

		<h1 class="center">Alterar Técnico</h1>
		<form class="form" method="post">
			
			<label>Nome do técnico</label>
			<input type="text" name="nome" class="input-text" value="<?= $resultados->nome; ?>" required>

			<label>CPF</label>
			<input type="text" name="cpf" class="input-text" value="<?= $resultados->cpf; ?>" required>

			<input type="hidden" name="id" class="input-text" value="<?= $resultados->id; ?>" readonly>

			<input type="submit" name="AlterarTec" value="Alterar" class="btn-4">

		</form>

	</section>
</body>
</html>