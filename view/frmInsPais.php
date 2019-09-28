<?php
    require_once('../controller/PaisController.php');
    
    if(isset($_POST['txtNome'])){
        $nome = trim($_POST['txtNome']);
        $paisController = new PaisController;
        $paisController->addPais($nome);
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
        <h2>Cadastrar novo País</h2>
        <hr/>
        <input type="button" value="Voltar" onclick="javascript: location.href='lstPais'">
        <form id="frmInsEquipe" name="frmInsEquipe" action="frmInsPais.php" method="POST">
            <div>
                <label for="lblNome">Nacionalidade</label>
                <input type="text" name="txtNome" id="txtNome" placeholder="Nome do Pais" autocomplete="off">
            </div>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>