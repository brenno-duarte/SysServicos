<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();
$resultados = Usuarios::listarUsuAlt();

$usuarios = new Usuarios();

if (isset($_POST['AlterarUsu'])){
	$usuarios->updateUsu();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Alterar Usuário</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<section class="container">

		<h1 class="center">Alterar Usuário</h1>
		<form class="form" method="post">
			
			<label>Nome do usuário</label>
			<input type="text" name="nome" class="input-text" value="<?= $resultados->nome; ?>" required>

			<label>CPF</label>
			<input type="text" name="cpf" class="input-text" value="<?= $resultados->cpf; ?>" required>

			<label>Telefone</label>
			<input type="text" name="fone" class="input-text" value="<?= $resultados->fone; ?>" required>

			<label>Login</label>
			<input type="text" name="login" class="input-text" value="<?= $resultados->login; ?>" required>

			<label>Senha</label>
			<input type="password" name="senha" class="input-text" value="<?= $resultados->senha; ?>" required>

			<!--<label>Confirmar senha</label>
			<input type="password" name="confSenha" class="input-text">-->

			<input type="hidden" name="id" class="input-text" value="<?= $resultados->idUsu; ?>" readonly>

			<input type="submit" name="AlterarUsu" value="Alterar" class="btn-4">

		</form>

	</section>
</body>
</html>