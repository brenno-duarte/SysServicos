<?php
session_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

$usuarios = new Usuarios();

$id = $_GET['id'];

$resultados = $usuarios->find($id);

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

        <?php
        $usuarios = new Usuarios();

        $cpf = filter_input(INPUT_POST, 'cpf');
        $fone = filter_input(INPUT_POST, 'fone');
        $login = filter_input(INPUT_POST, 'login');
        $nome = filter_input(INPUT_POST, 'nome');
        $senha = filter_input(INPUT_POST, 'senha');
        $confSenha = filter_input(INPUT_POST, 'confSenha');

        if (isset($_POST['alterar'])) {

            if ($senha != $confSenha) {
                echo 'Senhas não batem';
            } else {
                $usuarios->setCpf($cpf);
                $usuarios->setFone($fone);
                $usuarios->setLogin($login);
                $usuarios->setNome($nome);
                $usuarios->setSenha($senha);

                if ($usuarios->update($id)) {
                    echo 'Alterado com sucesso!';
                }
            }
        }
        ?>

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

                <label>Confirmar senha</label>
                <input type="password" name="confSenha" class="input-text">

                <input type="hidden" name="id" class="input-text" value="<?= $resultados->idUsu; ?>" readonly>

                <input type="submit" name="alterar" value="Alterar" class="btn-4">

            </form>

        </section>
    </body>
</html>