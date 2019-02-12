<?php
session_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();
?>

<?php include 'header.php'; ?>
    <body>

        <?php
        $usuarios = new Usuarios();

        $cpf = filter_input(INPUT_POST, 'cpf');
        $fone = filter_input(INPUT_POST, 'fone');
        $login = filter_input(INPUT_POST, 'login');
        $nome = filter_input(INPUT_POST, 'nome');
        $senha = filter_input(INPUT_POST, 'senha');
        $confSenha = filter_input(INPUT_POST, 'confSenha');

        if (isset($_POST['cadastrar'])) {

            if ($senha != $confSenha) {
                echo 'Senhas não batem';
            } else {
                $usuarios->setCpf($cpf);
                $usuarios->setFone($fone);
                $usuarios->setLogin($login);
                $usuarios->setNome($nome);
                $usuarios->setSenha($senha);

                if ($usuarios->insert()) {
                    header('location: usuarios.php');
                }
            }
        }
        ?>

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

                <input type="submit" name="cadastrar" value="Cadastrar" class="btn-4">

            </form>

        </section>
    </body>
</html>