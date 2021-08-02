<?php
define('__ROOT__', '../..');
require_once(__ROOT__.'/controller/EquipeController.php');

if (isset($_GET['id'])) {
    $id_equipe = $_GET['id'];

    $equipeController = new EquipeController();
    $equipe = $equipeController->listarPorId($id_equipe);
}

if (isset($_POST['txtNome'])) {
    $id_equipe = $_POST['txtId'];
    var_dump($id_equipe);
    $equipeController = new EquipeController();
    $equipeController->removerEquipe($id_equipe);
    header('Location: '.__ROOT__.'/view/lstEquipe.php');
    die();
}

$titulo = $equipe->getNome();
require_once(__ROOT__.'/view/layout/header.php');
?>

<div class="jumbotron bg-white py-4">
    <h2>Remover - <?= $equipe->getNome() ?></h2>
    <hr class="bg-dark" />
    <a href="<?= __ROOT__ ?>/view/equipes/lstEquipe.php" class="btn btn-info">Voltar</a>
    <div class="row justify-content-center">
        <div class="col-md-11 mt-2">
            <div class="jumbotron bg-secondary pt-5 pb-3 border border-white text-white font-weight-bold">
                <form name="fRemEquipe" action="frmRemEquipe.php?id=<?= $id_equipe ?>" method="POST">
                    <div class="form-group row">
                        <label for="lblId" class="col-md-1 col-form-label text-right">ID</label>
                        <div class="col-md-10">
                            <input type="hidden" name="txtId" id="txtId" value="<?= $equipe->getId() ?>">
                            <input type="text" class="form-control" value="<?= $equipe->getId() ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lblNome" class="col-md-1 col-form-label text-right">Equipe</label>
                        <div class="col-md-10">
                            <input type="hidden" name="txtNome" value="<?= $equipe->getNome() ?>">
                            <input type="text" class="form-control" value="<?= $equipe->getNome() ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lblSigla" class="col-md-1 col-form-label text-right">Sigla</label>
                        <div class="col-md-10">
                            <input type="hidden" name="txtSigla" value="<?= $equipe->getSigla() ?>">
                            <input type="text" class="form-control" value="<?= $equipe->getSigla() ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lblPais" class="col-md-1 col-form-label text-right">País</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="<?= $equipe->getPais()->getNome() ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group offset-md-1">
                        <input type="submit" class="center-block btn btn-outline-light" value="Remover">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php require_once(__ROOT__.'/view/layout/footer.php'); ?>