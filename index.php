<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

if (isset($_POST['validar'])){
	Usuarios::validarLogin();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>SysServiços</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
</head>
<body style="background-color: #4A708B;">

	<section class="container">

		<form class="form" method="post">
			<div class="center">
				<img style="width: 400px; height: 200px;" src="img/sysserviçoslogo.png">
			</div>

			<?php
			if (isset($_SESSION['error'])) {
				$error = $_SESSION['error'];
				echo "<p class='s-caution'>$error</p>";
			}
			?>

			<label>Login</label>
			<input type="text" name="login" class="input-text">

			<label>Senha</label>
			<input type="password" name="senha" class="input-text">

			<input type="submit" name="validar" value="Acessar" class="btn-6 btn-resp">
		</form>

	</section>

</body>
</html>

<?php //unset($_SESSION['error']); ?>