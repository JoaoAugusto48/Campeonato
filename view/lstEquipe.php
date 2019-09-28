<?php
    require_once('../controller/EquipeController.php');
    $equipeController = new EquipeController();

    $equipe = $equipeController->listarNome();

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equipes - Times</title>
    </head>
    <body>
        <h2>Lista de Times</h2>
        <hr/>
        <input type="button" value="Voltar" onclick="javascript: location.href='menu'">
        <input type="button" value="Inserir Equipe" onclick="javascript: location.href='frmInsEquipe'">
        <br><br>
        <table>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>SIGLA</th>
                <th>PAIS</th>
                <th>OPERAÇÕES</th>
            </tr>
            <?php foreach($equipe as $row) { ?>
            <tr>
                <td><?= $row->getId() ?></td>
                <td><?= $row->getNome() ?></td>
                <td><?= $row->getSigla() ?></td>
                <td><?= $row->getPais()->getNome() ?></td>
                <th>
                    <input type="button" value="Editar" onclick="javascript: location.href='frmEdtEquipe?id='+<?= $row->getId() ?>">
                    <input type="button" value="Remover">
                </th>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>