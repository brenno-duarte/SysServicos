<?php
session_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

$id = filter_input(INPUT_GET, 'id');

$os = new OS();
$resultados = $os->listarOSOrc($id);
?>

<?php include 'header.php'; ?>
<body>

    <?php
    $calcular = filter_input(INPUT_POST, 'calcularValor');

    $valorp = filter_input(INPUT_POST, 'valorp');
    $valors = filter_input(INPUT_POST, 'valors');
    $desconto = filter_input(INPUT_POST, 'desconto');

    $total = $valorp + $valors;
    $totalD = ($valorp + $valors) - $desconto;

    /*if (is_numeric($totalD)) {
        return $totalD = ($valorp + $valors) - $desconto;
    }*/
    
    //echo $id. '<br>';
    //echo $totalD;

    if (isset($calcular)) {

        if (empty($desconto)) {
            if ($os->orcamentoTotal($id, $total)) {
                echo 'calculado total';
            }
        }

        if (!empty($desconto)) {
            if ($os->orcamentoD($id, $totalD)) {
                echo 'calculado com desconto';
            }
        }

        /*if (isset($total)) {
      $os->orcamentoTotal($id, $total);
      }

      if (isset($totalD)) {
      $os->orcamentoD($id, $totalD);
      }*/
    }
    
    ?>

    <?php include 'menu.php'; ?>

    <section class="container">

        <h1 class="center">Diagnóstico/Orçamento</h1>
        <form class="form" method="post">

            <label for="id">ID OS</label>
            <input type="text" name="id" class="input-text" value="<?= $resultados->id; ?>" readonly>

            <label for="nome">Nome do cliente</label>
            <input type="text" id="nome" name="nome" class="input-text" value="<?= $resultados->nome; ?>" disabled>

            <label for="situacao">Situação</label>
            <input type="text" id="situacao" name="situacao" class="input-text" value="<?= $resultados->situacao; ?>" disabled>

            <label for="equip">Equipamento</label>
            <input type="text" id="equip" name="equip" class="input-text" value="<?= $resultados->equip; ?>" disabled>

            <label for="valorp">Valor das Peças(R$)</label>
            <input type="text" id="valorp" name="valorp" class="input-text" required>

            <label for="valors">Valor do Serviço(R$)</label>
            <input type="text" id="valors" name="valors" class="input-text" required>

            <label for="desconto">Desconto(R$)</label>
            <input type="text" id="desconto" name="desconto" class="input-text">

            <input type="submit" name="calcularValor" value="Salvar" class="btn-4">

        </form>

    </section>

</body>
</html>