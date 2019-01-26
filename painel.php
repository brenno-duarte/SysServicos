<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();
unset($_SESSION['error']);

//$resultados = OS::listarOS();
$resultados2 = OS::listarOS2();

?>

<!DOCTYPE html>
<html>
<head>
	<title>SysServiços - Início</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	
	<section class="container">
		<?php include 'welcome.php'; ?>
	</section>

	<!--<section class="container">
		<img class="center" src="img/sysserviçoslogo.png">
	</section>-->

	<table class="table-resp">
		<caption>Ordem de Serviço pendente</caption>
		<thead>
			<tr>
				<th>Nome do cliente</th>
				<th>Situação</th>
				<th>Equipamento</th>
				<th>Valor(R$)</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($resultados2 as $res): ?>
				<tr>
					<td><?= $res->nome; ?></td>
					<td style="color: red; font-weight: bold;"><?= $res->situacao; ?></td>
					<td><?= $res->equip; ?></td>
					<td><?= $res->valor; ?></td>
					<td><a href="#" class="btn-4">Finalizar</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	

</body>
</html>