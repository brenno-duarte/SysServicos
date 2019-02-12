<?php
session_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login no SysServiços</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
        <link rel="icon" href="img/logo/sysservicos-icon.png" />
    </head>
    <body style="background-color: #4A708B;">

        <?php
        
        $usuarios = new Usuarios();
        
        $login = filter_input(INPUT_POST, 'login');
        $senha = filter_input(INPUT_POST, 'senha');
        
        if (isset($_POST['validar'])) {
            if ($usuarios->validarLogin($login,$senha)) {
                echo 'logado';
            }
        }
        
        ?>

        <section class="container">

            <form class="form" method="post">
                <div class="center">
                    <img style="width: 400px; height: 200px;" src="img/logo/sysservicoslogo.png">
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

                <input type="submit" name="validar" value="Acessar" class="btn-6">
            </form>

        </section>

    </body>
</html>