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
    $titulo = 'Editar País';
    require_once('header.php');
 ?>

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
 

<?php require_once('footer.php'); ?>