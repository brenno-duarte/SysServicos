<?php
session_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

$clientes = new Clientes();
$tec = new Tecnicos();

$os = new OS();
$id = $_GET['id'];

$resultados = $os->find($id);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Alterar OS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/CustomCSS.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>
        
        <?php
        
        //
        
        ?>
        
        <?php include 'menu.php'; ?>

        <section class="container">

            <h1 class="center">Alterar Ordem de Serviço</h1>
            <form class="form" method="post">

                <label for="nome">Nome do cliente</label>
                <select name="nome" class="input-text">
                    <option selected disabled>--Selecione o nome do cliente--</option>
                    <?php foreach ($clientes->findAll() as $res): ?>
                        <option value="<?= $res->id; ?>"><?= $res->nome; ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="hidden" name="situacao" value="Aguardando diagnóstico" class="input-text" required>

                <label for="equip">Equipamento</label>
                <input type="text" id="equip" name="equip" class="input-text" value="<?= $resultados->equip; ?>" required>

                <label for="defeito">Defeito</label>
                <input type="text" id="defeito" name="defeito" class="input-text" value="<?= $resultados->defeito; ?>" required>

                <label>Técnico</label>
                <select name="tecnico" class="input-text">
                    <option selected disabled>--Selecione o técnico--</option>
                    <?php foreach ($tec->findAll() as $res): ?>
                        <option value="<?= $res->id; ?>"><?= $res->nome; ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="valor">Valor(R$)</label>
                <input type="text" id="valor" name="valor" class="input-text" value="<?= $resultados->valor; ?>" required>

                <input type="hidden" name="id" class="input-text" value="<?= $resultados->id; ?>" readonly>

                <input type="submit" name="AlterarOS" value="Alterar" class="btn-4">

            </form>

        </section>
    </body>
</html>