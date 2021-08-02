<?php
define('__ROOT__', '../..');
require_once('../controller/PaisController.php');
$paisController = new PaisController();

$pais = $paisController->listarPais();


$titulo = 'Países - Nacionalidade';
require_once(__ROOT__.'/view/layout/header.php');
?>

<h2>Lista de Paises</h2>
<hr class="bg-dark" />
<input type="button" class="btn btn-info" value="Voltar" onclick="javascript: location.href='menu'">
<input type="button" class="btn btn-info" value="Inserir País" onclick="javascript: location.href='frmInsPais'">
<input type="button" class="btn btn-info" value="Recuperar País">
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
                    <input type="button" class="btn btn-outline-primary" value="Editar" onclick="javascript: location.href='frmEdtPais?id='+<?= $row->getId() ?>">
                    <input type="button" class="btn btn-outline-warning" value="Remover" onclick="javascript: location.href='frmRemPais?id='+<?= $row->getId() ?>">
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php require_once(__ROOT__.'/view/layout/footer.php'); ?>