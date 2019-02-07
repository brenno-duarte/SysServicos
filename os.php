<?php
session_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

$resultados = OS::listarOS();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ordem de serviço</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>
        
        <?php
        
        
        
        ?>
        
        <?php include 'menu.php'; ?>

        <section class="container">
            <a href="novo_os.php" class="btn-3">Nova ordem de serviço</a>
        </section>

        <table class="table-resp">
            <caption>Ordem de Serviço</caption>
            <thead>
                <tr>
                    <th>ID OS</th>
                    <th>Nome do cliente</th>
                    <th>Situação</th>
                    <th>Equipamento</th>
                    <th>Data da OS</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($resultados as $res): ?>
                    <tr>
                        <td><?= $res->id; ?></td>
                        <td><?= $res->nome; ?></td>
                        <td><?= $res->situacao; ?></td>
                        <td><?= $res->equip; ?></td>
                        <td><?= $res->dataOs; ?></td>
                        <td><a href="alt_os.php?id=<?= $res->id; ?>"><img src="img/Modify.png"></a></td>
                        <td><a href="classes/deleteOS.php?id=<?= $res->id; ?>"><img src="img/Delete.png"></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>