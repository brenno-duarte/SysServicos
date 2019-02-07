<?php
session_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Técnicos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>

        <?php
        $tec = new Tecnicos();
        
        $id = filter_input(INPUT_GET, 'id');

        if (isset($id)) {
            if ($tec->delete($id)) {
                echo 'Deletado com sucesso';
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