<?php
define('__ROOT__', '../..');
require_once(__ROOT__ . '/controller/PaisController.php');

if (isset($_POST['txtNome'])) {
    $nome = trim($_POST['txtNome']);
    $paisController = new PaisController;
    $paisController->addPais($nome);
    header('Location: ' . __ROOT__ . '/view/paises/lstPais.php');
    die();
}
$titulo = 'Inserir País';
require_once(__ROOT__ . '/view/layout/header.php');
?>
<div class="jumbotron bg-white py-4">
    <h2>Cadastrar novo País</h2>
    <hr class="bg-dark" />
    <a href="<?= __ROOT__ ?>/view/paises/lstPais.php" class="btn btn-info">Voltar</a>
    <div class="row justify-content-center">
        <div class="col-md-11 mt-2">
            <div class="jumbotron bg-secondary pt-5 pb-3 border border-white text-white font-weight-bold">
                <form name="fvalida" action="frmInsPais.php" method="POST">
                    <div class="form-group row">
                        <label for="lblNome" class="col-md-2 col-form-label text-right">Nacionalidade</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="txtNome" id="txtNome" placeholder="Nome do País" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group offset-md-2">
                        <button type="button" class="center-block btn btn-outline-light" onclick="valida_pais()">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/Pais.js"></script>

<?php require_once(__ROOT__ . '/view/layout/footer.php'); ?>