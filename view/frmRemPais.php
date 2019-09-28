<?php
    require_once('../controller/PaisController.php');
    //acesso a página
    if(isset($_GET['id'])){
        $id = trim($_GET['id']);
        
        $paisController = new PaisController(); 
        $pais = $paisController->selecionarPais($id);
    }
    //Remover Logicamente registro
    if(isset($_POST['txtNome'])){
        $id = trim($_POST['txtId']);
        $paisController = new PaisController();
        $paisController->remLogPais($id);
        header('Location: lstPais');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Inserir País</title>
    </head>
    <body>
        <h2>Remover País</h2>
        <hr/>
        <input type="button" value="Voltar" onclick="javascript: location.href='lstPais'">
        <form id="frmEdtPais" name="frmEdtPais" action="frmRemPais" method="POST">
            <div>
                <label for="lblId">ID: <?= $pais->getId() ?></label>
                <input type="hidden" name='txtId' value="<?= $pais->getId() ?>">
            </div>            
            <div>
                <label for="lblNome">Nacionalidade: <?= $pais->getNome() ?></label>
                <input type="hidden" name="txtNome" id="txtNome" value="<?= $pais->getNome() ?>">
            </div>
            <input type="submit" value="Remover">
        </form>
    </body>
</html>