<?php
define('__ROOT__', '../..');
require_once(__ROOT__ . '/controller/PaisController.php');
$paisController = new PaisController();

$pais = $paisController->listarPais();


$titulo = 'Países - Nacionalidade';
require_once(__ROOT__ . '/view/layout/header.php');
?>

<h2>Lista de Paises</h2>
<hr class="bg-dark" />
<a href="<?= __ROOT__ ?>/view/campeonato/menu.php" class="btn btn-info">Voltar</a>
<a href="<?= __ROOT__ ?>/view/paises/frmInsPais.php" class="btn btn-info">Inserir País</a>
<a href="#" class="btn btn-info">Recuperar País</a>
<br><br>
<table class="table table-striped text-center">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>OPERAÇÕES</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pais as $row) { ?>
            <tr>
                <td><?= $row->getId() ?></td>
                <td><?= strip_tags($row->getNome()) ?></td>
                <td>
                    <a href="<?= __ROOT__ ?>/view/paises/frmEdtPais.php?id=<?= $row->getId() ?>" class="btn btn-primary">Editar</a>
                    <a href="<?= __ROOT__ ?>/view/paises/frmRemPais.php?id=<?= $row->getId() ?>" class="btn btn-warning">Remover</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php require_once(__ROOT__ . '/view/layout/footer.php'); ?>