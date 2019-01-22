<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();
$resultados = OS::listarOSAlt();
$resultados2 = Clientes::listarCli();

$os = new OS();

if (isset($_POST['AlterarOS'])){
	$os->updateOS();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Alterar OS</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<section class="container">

		<h1 class="center">Alterar Ordem de Serviço</h1>
		<form class="form" method="post">
			
			<label>Nome do cliente</label>
			<select name="nome" class="input-text">
				<option selected disabled>--Selecione o nome do cliente--</option>
				<?php foreach ($resultados2 as $res): ?>
				<option value="<?= $res->id; ?>"><?= $res->nome; ?></option>
				<?php endforeach; ?>
			</select>

			<input type="hidden" name="situacao" value="Aguardando diagnóstico" class="input-text" required>

			<label>Equipamento</label>
			<input type="text" name="equip" class="input-text" value="<?= $resultados->equip; ?>" required>

			<label>Defeito</label>
			<input type="text" name="defeito" class="input-text" value="<?= $resultados->defeito; ?>" required>

			<label>Técnico</label>
			<input type="text" name="tecnico" class="input-text" value="<?= $resultados->tecnico; ?>" required>

			<label>Valor(R$)</label>
			<input type="text" name="valor" class="input-text" value="<?= $resultados->valor; ?>" required>

			<input type="hidden" name="id" class="input-text" value="<?= $resultados->id; ?>" readonly>

			<input type="submit" name="AlterarOS" value="Alterar" class="btn-4">

		</form>

	</section>
</body>
</html>