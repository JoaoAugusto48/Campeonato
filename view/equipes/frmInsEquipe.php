<?php
define('__ROOT__', '../..');
require_once('../controller/EquipeController.php');
require_once('../controller/PaisController.php');

$paisController = new PaisController();
$pais = $paisController->listarPais();

if (isset($_POST['txtNome']) && isset($_POST['txtSigla']) && isset($_POST['idPais'])) {
    $nome = $_POST['txtNome'];
    $sigla = $_POST['txtSigla'];
    $idpais = $_POST['idPais'];
    $equipe = new EquipeController();
    $equipe->insEquipe($nome, $sigla, $idpais);
    header('Location: lstEquipe');
    die();
}

$titulo = 'Inserir Equipe';
require_once(__ROOT__.'/view/layout/header.php');
?>

<div class="jumbotron bg-white py-4">
    <h2>Cadastrar nova Equipe</h2>
    <hr class="bg-dark">
    <input type="button" class="btn btn-info" value="Voltar" onclick="javascript: location.href='lstEquipe'">
    <div class="row justify-content-center">
        <div class="col-md-11 mt-2">
            <div class="jumbotron bg-secondary pt-5 pb-3 border border-white text-white font-weight-bold">
                <form id="frmInsEquipe" name="fequipe" action="frmInsEquipe" method="POST">
                    <div class="form-group row">
                        <label for="lblNome" class="col-md-1 col-form-label text-right">Equipe</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="txtNome" id="txtNome" placeholder="Nome da Equipe" maxlength="30" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lblSigla" class="col-md-1 col-form-label text-right">Sigla</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="txtSigla" id="txtSigla" placeholder="Sigla" maxlength="4" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lblPais" class="col-md-1 col-form-label text-right">País</label>
                        <div class="col-md-10">
                            <select name="idPais" class="form-control">
                                <?php foreach ($pais as $row) { ?>
                                    <option value="<?= $row->getId() ?>"><?= $row->getNome() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group offset-md-1">
                        <input type="button" class="center-block btn btn-outline-light" value="Enviar" onclick="valida_equipe()">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/Equipe.js"></script>

<?php require_once(__ROOT__.'/view/layout/footer.php'); ?>