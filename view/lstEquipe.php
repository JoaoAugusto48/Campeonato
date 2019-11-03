<?php
    require_once('../controller/EquipeController.php');
    $equipeController = new EquipeController();

    $equipe = $equipeController->listarNome();

    $titulo = 'Equipes - Times';
    require_once('header.php');
?>

    <h2>Lista de Times</h2>
    <hr class="bg-dark" />
    <!-- <button class="btn-success"><i class="fa fa-home"></i>Voltar ao inicio</button> -->
    <input type="button" class="btn btn-info" value="Voltar" onclick="javascript: location.href='menu'">
    <input type="button" class="btn btn-info" value="Inserir Equipe" onclick="javascript: location.href='frmInsEquipe'">
    <br><br>
    <table class="table table-striped text-center table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>SIGLA</th>
                <th>PAIS</th>
                <th>OPERAÇÕES</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($equipe as $row) { ?>
            <tr>
                <td><?= $row->getId() ?></td>
                <td><?= strip_tags($row->getNome()) ?></td>
                <td><?= $row->getSigla() ?></td>
                <td><?= $row->getPais()->getNome() ?></td>
                <th>
                    <input type="button" class="btn btn-outline-primary" value="Editar" onclick="javascript: location.href='frmEdtEquipe?id='+<?= $row->getId() ?>">
                    <input type="button" class="btn btn-outline-warning" value="Remover" onclick="javascript: location.href='frmRemEquipe?id='+<?= $row->getId() ?>">
                </th>
            </tr>
            <?php } ?>
        </tbody>
    </table>

<?php require_once('footer.php'); ?>