<?php
    require_once('../controller/EstatisticaController.php');

    $id_Campeonato = $_GET['id'];

    $estatisticaController = new EstatisticaController();
    $estatistica = $estatisticaController->listarPorCampeonato($id_Campeonato);
    var_dump($estatistica);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
    <input type="button" value="Voltar" onclick="javascript: location.href='menu'">
    <input type="button" value="Inserir Equipe" onclick="javascript: location.href='menu'">
        <br><br>
        <table>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>VITORIA</th>
                <th>EMPATE</th>
                <th>DERROTA</th>
            </tr>
            <?php foreach($estatistica as $row) { ?>
            <tr>
                <td><?= $row->getId() ?></td>
                <td><?= $row->getIdEquipe() ?></td>
                <td><?= $row->getVitoria() ?></td>
                <td><?= $row->getEmpate() ?></td>
                <td><?= $row->getDerrota() ?></td>
                <th>
                    <input type="button" value="Editar" onclick="javascript: location.href='frmEdtEquipe?id='+<?= $row->getId() ?>">
                    <input type="button" value="Remover">
                </th>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>