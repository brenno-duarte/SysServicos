<?php
session_start();

spl_autoload_register(function($class){
	include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();
unset($_SESSION['error']);

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
	<?php include 'welcome.php'; ?>

	<section class="container">
		<img class="center" src="img/sysserviçoslogo.png">
	</section>

</body>
</html>