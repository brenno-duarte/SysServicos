<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();
$resultados = OS::listarOSOrc();

if (isset($_POST['calcularValor'])) {
	OS::orcamento();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Diagnóstico/Orçamento</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<section class="container">

		<h1 class="center">Diagnóstico/Orçamento</h1>
		<form class="form" method="post">
			
			<!--<label for="id">ID OS</label>-->
			<input type="text" name="id" class="input-text" value="<?= $resultados->idOS; ?>" readonly>

			<label for="nome">Nome do cliente</label>
			<input type="text" id="nome" name="nome" class="input-text" value="<?= $resultados->nome; ?>" disabled>

			<label for="situacao">Situação</label>
			<input type="text" id="situacao" name="situacao" class="input-text" value="<?= $resultados->situacao; ?>" disabled>

			<label for="equip">Equipamento</label>
			<input type="text" id="equip" name="equip" class="input-text" value="<?= $resultados->equip; ?>" disabled>

			<label for="valorp">Valor das Peças(R$)</label>
			<input type="text" id="valorp" name="valorp" class="input-text">

			<label for="valors">Valor do Serviço(R$)</label>
			<input type="text" id="valors" name="valors" class="input-text">

			<label for="desconto">Desconto(R$)</label>
			<input type="text" id="desconto" name="desconto" class="input-text">

			<input type="submit" name="calcularValor" value="Salvar" class="btn-4">

		</form>

	</section>

</body>
</html>