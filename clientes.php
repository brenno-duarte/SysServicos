<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

$resultados = Clientes::listarCli();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Clientes</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<section class="container">
		<a href="novo_cli.php" class="btn-3">Novo cliente</a>
	</section>

	<table class="table-resp">
		<caption>Clientes</caption>
		<thead>
			<tr>
				<th>Nome do cliente</th>
				<th>CPF</th>
				<th>Telefone</th>
			</tr>
		</thead>

		<tbody>

			<?php foreach ($resultados as $res): ?>
			<tr>
				<td><?= $res->nome; ?></td>
				<td><?= $res->cpf; ?></td>
				<td><?= $res->fone; ?></td>
				<td><a href="alt_cli.php?id=<?= $res->id; ?>"><img src="img/Modify.png"></a></td>
				<td><a href="classes/deleteCli.php?id=<?= $res->id; ?>"><img src="img/Delete.png"></a></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</body>
</html>