<?php
define('__ROOT__', '../..');
require_once(__ROOT__ . '/controller/CampeonatoController.php');

if (isset($_POST['txtNome']) && isset($_POST['nEquipe'])) {
    $nome = $_POST['txtNome'];
    $nEquipe = $_POST['nEquipe'];
    $turno = $_POST['chkTurno'] = isset($_POST['chkTurno']) ? true : false;

    $campeonatoController = new CampeonatoController();
    $campeonato = $campeonatoController->inserirCampeonato($nome, $nEquipe, $turno);
    header('Location: frmAddEquipes.php?id=' . $campeonato);
    die();
}

$titulo = 'Campeonato - Criar';
require_once(__ROOT__ . '/view/layout/header.php');
?>

<div class="jumbotron bg-white py-4">
    <h2>Criação de Campeonato</h2>
    <hr class="bg-dark" />
    <a href="<?= __ROOT__ ?>/view/campeonato/menu.php" class="btn btn-info">Menu</a>

    <div class="row justify-content-center">
        <div class="col-md-11 mt-2">
            <div class="jumbotron bg-secondary pt-5 pb-3 border border-white text-white font-weight-bold">
                <form name="fcampeonato" action="frmInsCampeonato" method="POST">
                    <div class="form-group row">
                        <label for="lblNome" class="col-md-3 col-form-label text-right">Nome do Campeonato</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="txtNome" placeholder="ex: Brasileirão" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lblNome" class="col-md-3 col-form-label text-right">Quantidade de Times</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="nEquipe" placeholder="ex: 10" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lblNome" class="col-md-3 col-form-label text-right">Habilitar 2º Turno</label>
                        <div class="col-md-1">
                            <input type="checkbox" class="form-control" name="chkTurno">
                        </div>
                    </div>
                    <div class="form-group offset-md-2">
                        <input type="button" class="center-block btn btn-outline-light" value="Enviar" onclick="valida_campeonato()">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/Campeonato.js"></script>

<?php require_once(__ROOT__ . '/view/layout/footer.php'); ?>