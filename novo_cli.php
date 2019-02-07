<?php
session_start();

ob_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Novo Cliente</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>

        <?php
        
        $clientes = new Clientes();

        if (isset($_POST['cadastrar'])) {

            $clientes->setNome($_POST['nome']);
            $clientes->setCpf($_POST['cpf']);
            $clientes->setFone($_POST['fone']);

            if ($clientes->insert()) {
                echo 'Cadastrado com sucesso';
            }
        }
        
        ?>

        <?php include 'menu.php'; ?>

        <section class="container">

            <h1 class="center">Novo Cliente</h1>
            <form class="form" method="post">

                <label for="nome">Nome do cliente</label>
                <input type="text" id="nome" name="nome" class="input-text" required>

                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" class="input-text" required>

                <label for="fone">Telefone</label>
                <input type="text" id="fone" name="fone" class="input-text" required>

                <input type="submit" name="cadastrar" value="Cadastrar" class="btn-4">

            </form>

        </section>
    </body>
</html>