<?php
    require_once('../controller/PaisController.php');
    //acesso a página
    if(isset($_GET['id'])){
        $id = trim($_GET['id']);
        
        $paisController = new PaisController(); 
        $pais = $paisController->selecionarPais($id);
    }
    //Editar registro
    if(isset($_POST['txtNome']) && isset($_POST['txtId'])){
        $id = trim($_POST['txtId']);
        $nome = trim($_POST['txtNome']);
        $paisController = new PaisController();
        $paisController->edtPais($id,$nome);
        header('Location: lstPais');
        die();
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
        <h2>Editar País</h2>
        <hr/>
        <input type="button" value="Voltar" onclick="javascript: location.href='lstPais'">
        <form id="frmEdtPais" name="frmEdtPais" action="frmEdtPais" method="POST">
            <div>
                <label for="lblId">ID: <?= $pais->getId() ?></label>
                <input type="hidden" name='txtId' value="<?= $pais->getId() ?>">
            </div>            
            <div>
                <label for="lblNome">Nacionalidade: </label>
                <input type="text" name="txtNome" id="txtNome" value="<?= $pais->getNome() ?>" placeholder="Nome do Pais" autocomplete="off">
            </div>
            <input type="submit" value="Editar">
        </form>
    </body>
</html>