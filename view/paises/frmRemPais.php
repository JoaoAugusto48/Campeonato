<?php
define('__ROOT__', '../..');
require_once(__ROOT__.'/controller/PaisController.php');
//acesso a página
if (isset($_GET['id'])) {
    $id = trim($_GET['id']);

    $paisController = new PaisController();
    $pais = $paisController->selecionarPais($id);
}
//Remover Logicamente registro
if (isset($_POST['txtNome'])) {
    $id = trim($_POST['txtId']);
    $paisController = new PaisController();
    $paisController->remLogPais($id);
    header('Location: '.__ROOT__.'/view/paises/lstPais.php');
    die();
}

$titulo = 'Remover País';
require_once(__ROOT__.'/view/layout/header.php');
?>

<div class="jumbotron bg-white py-4">
    <h2>Remover - <?= $pais->getNome() ?></h2>
    <hr class="bg-dark" />
    <input type="button" class="btn btn-info" value="Voltar" onclick="javascript: location.href='lstPais'">
    <div class="row justify-content-center">
        <div class="col-md-11 mt-2">
            <div class="jumbotron bg-secondary pt-5 pb-3 border border-white text-white font-weight-bold">
                <form name="frmRemPais" action="frmRemPais.php" method="POST">
                    <div class="form-group row">
                        <label for="lblNome" class="col-md-2 col-form-label text-right">ID</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="<?= $pais->getId() ?>" disabled>
                            <input type="hidden" class="form-control" name="txtId" value="<?= $pais->getId() ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lblNome" class="col-md-2 col-form-label text-right">Nacionalidade</label>
                        <div class="col-md-10">
                            <input type="hidden" name="txtNome" value="<?= $pais->getNome() ?>">
                            <input type="text" class="form-control" name="txtNome" value="<?= $pais->getNome() ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group offset-md-2">
                        <input type="submit" class="center-block btn btn-outline-light" value="Remover">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php require_once(__ROOT__.'/view/layout/footer.php'); ?>