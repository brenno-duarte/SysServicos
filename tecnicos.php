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
        
        $id = filter_input(INPUT_GET, 'id');

        if (isset($id)) {
            if ($tec->delete($id)) {
                header('location: tecnicos.php');
            }
        }
        ?>

        <?php include 'menu.php'; ?>

        <section class="container">
            <a href="novo_tec.php" class="btn-3">Novo técnico</a>
        </section>

        <table class="table-resp">
            <caption>Técnicos</caption>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($tec->findAll() as $res): ?>
                    <tr>
                        <td><?= $res->nome; ?></td>
                        <td><?= $res->cpf; ?></td>
                        <td><a href="alt_tec.php?id=<?= $res->id; ?>"><img src="img/Modify.png"></a></td>
                        <td><a href="tecnicos.php?id=<?= $res->id; ?>"><img src="img/Delete.png"></a></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </body>
</html>