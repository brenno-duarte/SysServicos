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
        
        $id = filter_input(INPUT_GET, 'id');
        
        if (isset($id)) {
            if ($usuarios->delete($id)) {
                header('location: usuarios.php');
            }
        }
        
        ?>
        
        <?php include 'menu.php'; ?>

        <section class="container">
            <a href="novo_usu.php" class="btn-3">Novo usuário</a>
        </section>

        <table class="table-resp">
            <caption>Usuários</caption>
            <thead>
                <tr>
                    <th>Nome do usuário</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($usuarios->findAll() as $res): ?>
                    <tr>
                        <td><?= $res->nome; ?></td>
                        <td><?= $res->cpf; ?></td>
                        <td><?= $res->fone; ?></td>
                        <td><a href="alt_usu.php?id=<?= $res->id; ?>"><img src="img/Modify.png"></a></td>
                        <td><a name='delete' href="usuarios.php?id=<?= $res->id; ?>"><img src="img/Delete.png"></a></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </body>
</html>