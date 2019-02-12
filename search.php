<?php
session_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

$clientes = Search::pesqCli();

?>

<?php include 'header.php'; ?>
<body>

    <?php include 'menu.php'; ?>

    <section class="container">

        <?php if (count($clientes) > 0): ?>

            <table class="table-resp">
                <caption>Resultados da busca</caption>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Equipamento</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($clientes as $cli): ?>
                        <tr>
                            <td><?= $cli->nome; ?></td>                           
                            <td><?= $cli->equip; ?></td>
                            <td><?= $cli->situacao; ?></td>
                            <td><a href="#" class="btn-4">Selecionar</a></td>
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