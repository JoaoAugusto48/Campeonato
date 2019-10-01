<?php
    require_once('../controller/PaisController.php');
    
    if(isset($_POST['txtNome'])){
        $nome = trim($_POST['txtNome']);
        $paisController = new PaisController;
        $paisController->addPais($nome);
        header('Location: lstPais');
        die();
    }
    $titulo = 'Inserir País';
    require_once('header.php');
 ?>

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


<?php require_once('footer.php');