<?php
define('__ROOT__', '../..');
$id_campeonato = $_GET['id'];

require_once(__ROOT__.'/controller/PartidaController.php');
require_once(__ROOT__.'/controller/EquipeController.php');
require_once(__ROOT__.'/controller/EstatisticaController.php');
require_once(__ROOT__.'/controller/CampeonatoController.php');

$partidaController = new PartidaController();
$equipeController = new EquipeController();
$estatisticaController = new EstatisticaController();
$campeonatoController = new CampeonatoController();


$campeonato = $campeonatoController->listarId($id_campeonato);
$rodadas = $campeonatoController->numeroRodadas($campeonato->getNEquipe(), $campeonato->getTurno());


if (isset($_POST['casa']) && isset($_POST['visitante']) && isset($_POST['idpartida'])) {
    if (is_numeric($_POST['casa']) && is_numeric($_POST['visitante'])) {
        $golcasa = $_POST['casa'];
        $golvisitante = $_POST['visitante'];
        $idpartida = $_POST['idpartida'];

        if (isset($_POST['equipecasa']) && isset($_POST['equipevisitante']) && isset($_POST['statuspartida'])) {
            $timecasa = $_POST['equipecasa'];
            $timevisitante = $_POST['equipevisitante'];
            $status = $_POST['statuspartida'];
            $estatisticaController->atualizarEstatistica($id_campeonato, $idpartida, $status, $timecasa, $golcasa, $timevisitante, $golvisitante);
            //atualizar a partida após a estatistica
            $partidaController->resultadoPartida($id_campeonato, $idpartida, $golcasa, $golvisitante);
        }
    }
}


$titulo = $campeonato->getNome();
require_once(__ROOT__.'/view/layout/header.php');
?>
<h2 id="0"><?= $campeonato->getNome() ?> - Jogos</h2>
<hr>
<a href="<?= __ROOT__ ?>/view/campeonato/lstEstatistica.php?id=<?= $id_campeonato ?>" class="btn btn-info">Voltar</a>
<br><br>
<!-- inicio botão das rodadas -->
<div class="text text-left">
    <?php for ($i = 0; $i < $rodadas; $i++) { ?>
        <a href="#<?= $i+1 ?>" class="btn btn-outline-primary col-md-1 mt-1">Rodada <?= $i+1 ?></a>
    <?php } ?>
</div>
<!-- fim botão das rodadas -->

<!-- inicio impressão das rodadas -->
<?php
for ($i = 0; $i < $rodadas; $i++) {
    $partida = $partidaController->listarPartidas($campeonato->getId(), $i);
?>
    <h3 id="<?= $i + 1 ?>" class="mt-2">Rodada <?= $i + 1 ?></h3>

    <table class="table mb-1">
        <?php foreach ($partida as $key => $row) {
            $casa = $equipeController->listarPorId($row->getTimeCasa());
            $visitante = $equipeController->listarPorId($row->getTimeVisitante());

            // não mostra valores ainda não inseridos
            if (!$row->getStatus()) {
                $mandante = '';
                $fora = '';
            } else {
                $mandante = $row->getNGolCasa();
                $fora = $row->getNGolVisitante();
            }
        ?>

            <tr>
                <form action="lstPartidas?id=<?= $id_campeonato ?>#<?= $i + 1 ?>" method="post">
                    <input type="hidden" name="idpartida" value="<?= $row->getId() ?>" class="rodada<?= $i ?>">
                    <input type="hidden" name="equipecasa" value="<?= $row->getTimeCasa() ?>" class="rodada<?= $i ?>">
                    <input type="hidden" name="equipevisitante" value="<?= $row->getTimeVisitante() ?>" class="rodada<?= $i ?>">
                    <input type="hidden" name="statuspartida" value="<?= $row->getStatus() ?>">

                    <td class="text-right"><?= $casa->getNome() ?></td>
                    <td class="text-center" style="width: 15%;">
                        <input type="text" name="casa" style="text-align: center" maxlength="2" size="1" value="<?= $mandante ?>" autocomplete="off" class="rodada<?= $i ?>">
                        x
                        <input type="text" name="visitante" style="text-align: center" maxlength="2" size="1" value="<?= $fora ?>" autocomplete="off" class="rodada<?= $i ?>">
                    </td>
                    <td class="text-left"><?= $visitante->getNome() ?></td>
                    <td><input type="submit" class="btn btn-outline-dark" value="Gravar"></td>
                </form>
            </tr>
        <?php } ?>
    </table>
    <p>botão Executar Rodada</p>
    <a href="#0" class="btn btn-primary">Voltar Topo</a>
<?php } ?>
<!-- fim impressão das rodadas -->
<?php require_once(__ROOT__.'/view/layout/footer.php'); ?>