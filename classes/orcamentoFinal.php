<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();
$resultados = OS::listarOSOrc();

$total = $_SESSION['total'];
$totalD = $_SESSION['totalD'];

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

		<h1 class="center">Finalizar Orçamento</h1>
		<form class="form" method="post">
			
			<!--<label for="id">ID OS</label>-->
			<input type="text" id="id" name="id" class="input-text" value="<?= $resultados->idOS; ?>" readonly>

			<label for="nome">Valor total</label>
			<input type="text" id="nome" name="nome" class="input-text" value="<?= $totalD ?>" disabled>

			<input type="submit" name="calcularValor" value="Calcular Valor total" class="btn-4">

		</form>

	</section>

</body>
</html>

<?php //unset($_SESSION['totalD']); unset($_SESSION['total']); ?>