<?php
session_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

$clientes = Search::pesqCli();
?>

<?php include 'header.php'; ?>
<body>
    <?php include 'menu.php'; ?>

    <section class="container">

        <?php if (count($clientes) > 0): ?>

            <table class="table-resp">
                <caption>Diagnóstico/Orçamento</caption>
                <thead>
                    <tr>
                        <th>ID OS</th>
                        <th>Cliente</th>
                        <th>Status</th>
                        <th>Equipamento</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($clientes as $res): ?>
                        <tr>
                            <td><?= $res->id; ?></td>
                            <td><?= $res->nome; ?></td>
                            <td><?= $res->situacao; ?></td>
                            <td><?= $res->equip; ?></td>
                            <td><a href="orcamento.php?id=<?= $res->id; ?>" class="btn-4">Selecionar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>

            <span class="table-resp" style="font-size: 25px;">Nenhum resultado encontrado</span>

            <section class="container">
                <a href="pesq.php" class="btn-1">Voltar</a>
            </section>

        <?php endif; ?>

    </section>

</body>
</html>