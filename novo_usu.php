<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

$usuarios = new Usuarios();

if (isset($_POST['CadastrarUsu'])){
	$usuarios->createUsu();
} 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Novo Usuário</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<section class="container">

		<h1 class="center">Novo Usuário</h1>
		<form class="form" method="post">
			
			<label>Nome do usuário</label>
			<input type="text" name="nome" class="input-text" required>

			<label>CPF</label>
			<input type="text" name="cpf" class="input-text" required>

			<label>Telefone</label>
			<input type="text" name="fone" class="input-text" required>

			<label>Login</label>
			<input type="text" name="login" class="input-text" required>

			<label>Senha</label>
			<input type="password" name="senha" class="input-text" required>

			<label>Confirmar senha</label>
			<input type="password" name="confSenha" class="input-text" required>

			<input type="submit" name="CadastrarUsu" value="Cadastrar" class="btn-4">

		</form>

	</section>
</body>
</html>