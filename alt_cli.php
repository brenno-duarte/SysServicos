<?php
session_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

$clientes = new Clientes();

Usuarios::verificarLogin();

$id = $_GET['id'];

$resultados = $clientes->find($id);
?>

<?php include 'header.php'; ?>
    <body>

        <?php
        //$clientes = new Clientes();

        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $fone = filter_input(INPUT_POST, 'fone');
        $idC = filter_input(INPUT_POST, 'id');

        if (isset($_POST['alterar'])) {

            $clientes->setNome($nome);
            $clientes->setCpf($cpf);
            $clientes->setFone($fone);

            if ($clientes->update($idC)) {
                header('location: clientes.php');
            }
        }
        ?>

        <?php include 'menu.php'; ?>

        <section class="container">

            <h1 class="center">Alterar Cliente</h1>
            <form class="form" method="post">

                <label>Nome do cliente</label>
                <input type="text" name="nome" class="input-text" value="<?= $resultados->nome; ?>" required>

                <label>CPF</label>
                <input type="text" name="cpf" class="input-text" value="<?= $resultados->cpf; ?>" required>

                <label>Telefone</label>
                <input type="password" name="fone" class="input-text" value="<?= $resultados->fone; ?>" required>

                <input type="hidden" name="id" class="input-text" value="<?= $resultados->id; ?>" required>

                <input type="submit" name="alterar" value="Alterar" class="btn-4">

            </form>

        </section>
    </body>
</html>