<?php
session_start();

ob_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

?>

<?php include 'header.php'; ?>
    <body>

        <?php
        
        $clientes = new Clientes();
        
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $fone = filter_input(INPUT_POST, 'fone');

        if (isset($_POST['cadastrar'])) {

            $clientes->setNome($nome);
            $clientes->setCpf($cpf);
            $clientes->setFone($fone);

            if ($clientes->insert()) {
                header('location: clientes.php');
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