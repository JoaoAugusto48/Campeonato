<?php
define('__ROOT__', '../..');
require_once(__ROOT__ . '/controller/EquipeController.php');
$equipeController = new EquipeController();

$equipe = $equipeController->listarNome();

$titulo = 'Equipes - Times';
require_once(__ROOT__ . '/view/layout/header.php');
?>

<h2>Lista de Times</h2>
<hr class="bg-dark" />
<!-- <button class="btn-success"><i class="fa fa-home"></i>Voltar ao inicio</button> -->
<a href="<?= __ROOT__ ?>/view/campeonato/menu.php" class="btn btn-info">Voltar</a>
<a href="<?= __ROOT__ ?>/view/equipes/frmInsEquipe.php" class="btn btn-info">Inserir Equipe</a>
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
        <?php foreach ($equipe as $row) { ?>
            <tr>
                <td><?= $row->getId() ?></td>
                <td><?= strip_tags($row->getNome()) ?></td>
                <td><?= $row->getSigla() ?></td>
                <td><?= $row->getPais()->getNome() ?></td>
                <th>
                    <a href="<?= __ROOT__ ?>/view/equipes/frmEdtEquipe.php?id=<?= $row->getId() ?>" class="btn btn-info">Editar</a>
                    <a href="<?= __ROOT__ ?>/view/equipes/frmRemEquipe.php?id=<?= $row->getId() ?>" class="btn btn-info">Remover</a>
                    <input type="button" class="btn btn-outline-primary" value="Editar" onclick="javascript: location.href='frmEdtEquipe?id='+<?= $row->getId() ?>">
                    <input type="button" class="btn btn-outline-warning" value="Remover" onclick="javascript: location.href='frmRemEquipe?id='+<?= $row->getId() ?>">
                </th>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php require_once(__ROOT__ . '/view/layout/footer.php'); ?>