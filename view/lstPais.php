<?php
    require_once('../controller/PaisController.php');
    $paisController = new PaisController();

    $pais = $paisController->listarPais();
    

    $titulo = 'Países - Nacionalidade';
    require_once('header.php');
?>

    <h2>Lista de Paises</h2>
    <hr/>
    <input type="button" value="Voltar" onclick="javascript: location.href='menu'">
    <input type="button" value="Inserir País" onclick="javascript: location.href='frmInsPais'">
    <input type="button" value="Recuperar País">
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>OPERAÇÕES</th>
        </tr>
        <?php foreach($pais as $row) { ?>
        <tr>
            <td><?= $row->getId() ?></td>
            <td><?= strip_tags($row->getNome()) ?></td>
            <td>
                <input type="button" value="Editar" onclick="javascript: location.href='frmEdtPais?id='+<?= $row->getId() ?>">
                <input type="button" value="Remover" onclick="javascript: location.href='frmRemPais?id='+<?= $row->getId() ?>">
            </td>
        </tr>
        <?php } ?>
    </table>

<?php require_once('footer.php'); ?>