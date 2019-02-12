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
        
        $tec = new Tecnicos();
        
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        
        if (isset($_POST['cadastrar'])) {
            $tec->setNome($nome);
            $tec->setCpf($cpf);
            
            if ($tec->insert()) {
                header('location: tecnicos.php');
            }
        }
        
        ?>
        
        <?php include 'menu.php'; ?>

        <section class="container">

            <h1 class="center">Novo Técnico</h1>
            <form class="form" method="post">

                <label for="nome">Nome do Técnico</label>
                <input type="text" id="nome" name="nome" class="input-text" required>

                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" class="input-text" required>

                <input type="submit" name="cadastrar" value="Cadastrar" class="btn-4">

            </form>

        </section>
    </body>
</html>