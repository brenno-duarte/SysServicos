<?php
session_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

$tec = new Tecnicos();

$id = $_GET['id'];

$resultados = $tec->find($id);

?>

<?php include 'header.php'; ?>
    <body>
        
        <?php
        
        $tec = new Tecnicos();
        
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        
        if (isset($_POST['alterar'])) {
            $tec->setNome($nome);
            $tec->setCpf($cpf);
            
            if ($tec->update($_POST['id'])) {
                header('location: tecnicos.php');
            }   
        }
        
        ?>
        
        <?php include 'menu.php'; ?>

        <section class="container">

            <h1 class="center">Alterar Técnico</h1>
            <form class="form" method="post">

                <label>Nome do técnico</label>
                <input type="text" name="nome" class="input-text" value="<?= $resultados->nome; ?>" required>

                <label>CPF</label>
                <input type="text" name="cpf" class="input-text" value="<?= $resultados->cpf; ?>" required>

                <input type="hidden" name="id" class="input-text" value="<?= $resultados->id; ?>" readonly>

                <input type="submit" name="alterar" value="Alterar" class="btn-4">

            </form>

        </section>
    </body>
</html>