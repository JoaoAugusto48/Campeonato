<?php
    $id_campeonato = $_GET['id'];

    require_once('../controller/PartidaController.php');
    require_once('../controller/EquipeController.php');
    require_once('../controller/EstatisticaController.php');
    require_once('../controller/CampeonatoController.php');

    $partidaController = new PartidaController();
    $equipeController = new EquipeController();
    $estatisticaController = new EstatisticaController();
    $campeonatoController = new CampeonatoController();
    
    
    $campeonato = $campeonatoController->listarId($id_campeonato);
    $rodadas = $campeonatoController->numeroRodadas($campeonato->getNEquipe(),$campeonato->getTurno());

    if(isset($_POST['casa']) && isset($_POST['visitante']) && isset($_POST['idpartida'])){
        if(is_numeric($_POST['casa']) && is_numeric($_POST['visitante'])){
            $golcasa = $_POST['casa'];
            $golvisitante = $_POST['visitante'];
            $idpartida = $_POST['idpartida'];
            
            if(isset($_POST['equipecasa']) && isset($_POST['equipevisitante']) && isset($_POST['statuspartida'])){
                $timecasa = $_POST['equipecasa'];
                $timevisitante = $_POST['equipevisitante'];
                $status = $_POST['statuspartida'];
                $estatisticaController->atualizarEstatistica($id_campeonato,$idpartida,$status,$timecasa,$golcasa,$timevisitante,$golvisitante);
                //atualizar a partida após a estatistica
                $partidaController->resultadoPartida($id_campeonato,$idpartida,$golcasa,$golvisitante);
            }
        } 
    }


    $titulo = $campeonato->getNome();
    require_once('header.php');
?>
    <h2><?= $campeonato->getNome() ?> - Jogos</h2>
    <hr>
    <input type="button" value="Voltar" onclick="javascript: location.href='lstEstatistica?id=<?= $id_campeonato ?>'">
    <br><br>
    <!-- inicio botão das rodadas -->
    <?php for($i=0;$i < $rodadas;$i++){ ?>
        <a href="#<?= $i+1 ?>"><input type="button" value="Rodada <?= $i+1 ?>"></a>
    <?php } ?>
    <!-- fim botão das rodadas -->

    <!-- inicio impressão das rodadas -->
    <?php for($i=0;$i < $rodadas;$i++){
            $partida = $partidaController->listarPartidas($campeonato->getId(),$i);
    ?>
    <h3 id="<?= $i+1 ?>">Rodada <?= $i+1 ?></h3>

    <table>       
        <?php foreach($partida as $row){ 
            $casa = $equipeController->listarPorId($row->getTimeCasa());
            $visitante = $equipeController->listarPorId($row->getTimeVisitante());

            if(!$row->getStatus()){
                $mandante = '';
                $fora = '';
            }else{
                $mandante = $row->getNGolCasa();
                $fora = $row->getNGolVisitante();
            }

        ?>
            <tr>
            <form action="lstPartidas?id=<?= $id_campeonato ?>#<?= $i+1 ?>" method="post">
                <input type="hidden" name="idpartida" value="<?= $row->getId() ?>">
                <input type="hidden" name="equipecasa" value="<?= $row->getTimeCasa() ?>">
                <input type="hidden" name="equipevisitante" value="<?= $row->getTimeVisitante() ?>">
                <input type="hidden" name="statuspartida" value="<?= $row->getStatus() ?>">

                <td align="right"><?= $casa->getNome() ?></td>
                <td><input type="text" name="casa" style="text-align: center" maxlength="2" size="1" value="<?= $mandante ?>" autocomplete="off">
                    x 
                <input type="text" name="visitante" style="text-align: center" maxlength="2" size="1" value="<?= $fora ?>" autocomplete="off"></td>
                <td><?= $visitante->getNome() ?></td>
                <td><input type="submit" value="Gravar"></td>
            </form>
            </tr>  

        <?php } ?>
    </table>
    <p>botão Executar Rodada</p>
    <?php } ?>
    <!-- fim impressão das rodadas -->

<?php require_once('footer.php'); ?>