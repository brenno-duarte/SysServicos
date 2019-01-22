<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

$clientes = Search::pesqCli();

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

		<?php if (count($clientes) > 0): ?>

			<table class="table-resp">
				<caption>Diagnóstico/Orçamento</caption>
				<thead>
					<tr>
						<th>Cliente</th>
						<th>Status</th>
						<th>Equipamento</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($clientesDiagnóstico/ as $res): ?>
						<tr>
							<td><?= $res->nome; ?></td>
							<td><?= $res->situacao; ?></td>
							<td><?= $res->equip; ?></td>
							<td><a href="#" class="btn-4">Selecionar</a></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<?php else: ?>

				<span class="table-resp" style="font-size: 25px;">Nenhum resultado encontrado</span>

				<section class="container">
					<a href="pesq.php" class="btn-1">Voltar</a>
				</section>

			<?php endif; ?>

		</section>

	</body>
	</html>