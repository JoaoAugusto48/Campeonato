<<<<<<< HEAD
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
            <td><?= $row->getNome() ?></td>
            <td>
                <input type="button" value="Editar" onclick="javascript: location.href='frmEdtPais?id='+<?= $row->getId() ?>">
                <input type="button" value="Remover" onclick="javascript: location.href='frmRemPais?id='+<?= $row->getId() ?>">
            </td>
        </tr>
        <?php } ?>
    </table>

<?php require_once('footer.php'); ?>
=======
<?php
    require_once('../controller/PaisController.php');
    $paisController = new PaisController();

    $pais = $paisController->listarPais();
    
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Países - Nacionalidade</title>
    </head>
    <body>
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
                <td><?= $row->getNome() ?></td>
                <td>
                    <input type="button" value="Editar" onclick="javascript: location.href='frmEdtPais?id='+<?= $row->getId() ?>">
                    <input type="button" value="Remover" onclick="javascript: location.href='frmRemPais?id='+<?= $row->getId() ?>">
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
>>>>>>> 04f6116eb9f2ad714e84a935ae8d64e67a8b762a
