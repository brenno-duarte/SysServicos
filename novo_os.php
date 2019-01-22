<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();
$resultados = Clientes::listarCli();

$os = new OS();

if (isset($_POST['CadastrarOS'])){
	$os->createOS();
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Nova OS</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<section class="container">

		<h1 class="center">Nova Ordem de Serviço</h1>
		<form class="form" method="post">
			
			<label>Nome do cliente</label>
			<select name="nome" class="input-text">
				<option selected disabled>--Selecione o nome do cliente--</option>
				<?php foreach ($resultados as $res): ?>
				<option value="<?= $res->id; ?>"><?= $res->nome; ?></option>
				<?php endforeach; ?>
			</select>

			<input type="hidden" name="situacao" value="Aguardando diagnóstico" class="input-text" required>

			<label>Equipamento</label>
			<input type="text" name="equip" class="input-text" required>

			<label>Defeito</label>
			<input type="text" name="defeito" class="input-text" required>

			<label>Técnico</label>
			<input type="text" name="tecnico" class="input-text" required>

			<label>Valor(R$)</label>
			<input type="text" name="valor" class="input-text" required>

			<input type="submit" name="CadastrarOS" value="Cadastrar" class="btn-4">

		</form>

	</section>
</body>
</html>