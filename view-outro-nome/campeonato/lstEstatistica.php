<?php
define('__ROOT__', '../..');
require_once(__ROOT__ . '/controller/EstatisticaController.php');
require_once(__ROOT__ . '/controller/CampeonatoController.php');
require_once(__ROOT__ . '/controller/EquipeController.php');

$id_campeonato = $_GET['id'];

$estatisticaController = new EstatisticaController();
$campeonatoController = new CampeonatoController();
$equipeController = new EquipeController();

$estatistica = $estatisticaController->listarPorCampeonato($id_campeonato);
$campeonato = $campeonatoController->listarId($id_campeonato);

// regras de classificação do campeonato 
$classificacao = $estatisticaController->classificacao($estatistica);

// var_dump($classificacao);
// die();

$timeCampeao = '';
if ($classificacao) {
    // definição do campeão /* como separar em metodo? */
    $campeao = $estatisticaController->listarCampeao($campeonato, $classificacao);

    if ($campeao) {
        $campeao = $equipeController->listarPorId($campeao);
        $timeCampeao = ' - Campeão <b>' . $campeao->getNome() . '</b>';
    }
    // até aqui
}

$titulo = $campeonato->getNome();
require_once(__ROOT__ . '/view/layout/header.php');
?>

<h2><?= $campeonato->getNome() . $timeCampeao ?></h2>
<hr class="bg-dark">
<a href="<?= __ROOT__ ?>/view/campeonato/menu.php" class="btn btn-info">Menu</a>
<a href="<?= __ROOT__ ?>/view/campeonato/lstPartidas.php?id=<?= $id_campeonato ?>" class="btn btn-info">Jogos</a>
<br><br>


<?php if (!$classificacao) { ?>
    <h2>Ainda não há equipes cadastradas</h2>
    <a href="<?= __ROOT__ ?>/view/equipes/frmAddEquipes.php?id=<?= $campeonato->getId() ?>" class="btn btn-info">Adicionar Equipes</a>
<?php } else { ?>
    <table class="table table-striped table-hover bg-light">
        <thead class="thead-dark">
            <tr class="text-center">
                <th>#</th>
                <th>NOME</th>
                <th>JOGOS</th>
                <th>VITORIA</th>
                <th>EMPATE</th>
                <th>DERROTA</th>
                <th>GOLS</th>
                <th>AGV (%)</th>
                <th>PONTOS</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
            $i = 1;
            foreach ($classificacao as $row) {
            ?>
                <tr <?php if ($i == 1) { ?> class="bg-info text-white font-weight-bold" <?php } ?>>
                    <!-- style="background-color: #000" -->
                    <td><?= $i ?></td>
                    <td class="text-start"><?= strip_tags($row->getEquipe()->getNome()) ?></td>
                    <td><?= $estatisticaController->jogos($row->getId(), $row->getVitoria(), $row->getEmpate(), $row->getDerrota()) ?></td>
                    <td><?= $row->getVitoria() ?></td>
                    <td><?= $row->getEmpate() ?></td>
                    <td><?= $row->getDerrota() ?></td>
                    <td>
                        <?= $row->getGolPro() ?>/<?= $row->getGolContra() ?>
                    </td>
                    <td><?= $estatisticaController->average($row->getVitoria(), $row->getEmpate(), $row->getDerrota()) ?>%</td>
                    <td><?= $estatisticaController->pontos($row->getId(), $row->getVitoria(), $row->getEmpate()) ?></td>
                </tr>
            <?php $i++;
            } ?>
        </tbody>
    </table>
<?php } ?>

<?php require_once(__ROOT__ . '/view/layout/footer.php'); ?>