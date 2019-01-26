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
			
			<label for="nome">Nome do usuário</label>
			<input type="text" id="nome" name="nome" class="input-text" required>

			<label for="cpf">CPF</label>
			<input type="text" id="cpf" name="cpf" class="input-text" required>

			<label for="fone">Telefone</label>
			<input type="text" id="fone" name="fone" class="input-text" required>

			<label for="login">Login</label>
			<input type="text" id="login" name="login" class="input-text" required>

			<label for="senha">Senha</label>
			<input type="password" id="senha" name="senha" class="input-text" required>

			<label for="confSenha">Confirmar senha</label>
			<input type="password" id="confSenha" name="confSenha" class="input-text" required>

			<input type="submit" name="CadastrarUsu" value="Cadastrar" class="btn-4">

		</form>

	</section>
</body>
</html>