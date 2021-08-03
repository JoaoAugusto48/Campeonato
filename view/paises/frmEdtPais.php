<?php
define('__ROOT__', '../..');
require_once(__ROOT__.'/controller/PaisController.php');
//acesso a página
if (isset($_GET['id'])) {
    $id = trim($_GET['id']);

    $paisController = new PaisController();
    $pais = $paisController->selecionarPais($id);
}

//Editar registro
if (isset($_POST['txtNome']) && isset($_POST['txtId'])) {
    $id = trim($_POST['txtId']);
    $nome = trim($_POST['txtNome']);
    $paisController = new PaisController();
    $paisController->edtPais($id, $nome);
    header('Location: '.__ROOT__.'/view/paises/lstPais.php');
    die();
}
$titulo = 'Editar País';
require_once(__ROOT__.'/view/layout/header.php');
?>

<div class="jumbotron bg-white py-4">
    <h2>Editar - <?= $pais->getNome() ?></h2>
    <hr class="bg-dark" />
    <a href="<?= __ROOT__ ?>/view/paises/lstPais.php" class="btn btn-info">Voltar</a>
    <div class="row justify-content-center">
        <div class="col-md-11 mt-2">
            <div class="jumbotron bg-secondary pt-5 pb-3 border border-white text-white font-weight-bold">
                <form name="fvalida" action="frmEdtPais.php" method="POST">
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
                            <input type="text" class="form-control" name="txtNome" value="<?= $pais->getNome() ?>" placeholder="Nome do País" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group offset-md-2">
                        <button type="button" class="center-block btn btn-outline-light" onclick="valida_pais()">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/Pais.js"></script>

<?php require_once(__ROOT__.'/view/layout/footer.php'); ?>