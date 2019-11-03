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
    <h2 id="0"><?= $campeonato->getNome() ?> - Jogos</h2>
    <hr>
    <input type="button" value="Voltar" class="btn btn-info" onclick="javascript: location.href='lstEstatistica?id=<?= $id_campeonato ?>'">
    <br><br>
    <!-- inicio botão das rodadas -->
    <div class="text text-left">
        <?php for($i=0;$i < $rodadas;$i++){ ?>
            <a href="#<?= $i+1 ?>"><input type="button" class="btn btn-outline-primary col-md-1 mt-1" value="Rodada <?= $i+1 ?>"></a>
        <?php } ?>
    </div>
    <!-- fim botão das rodadas -->

    <!-- inicio impressão das rodadas -->
    <?php 
        for($i=0;$i < $rodadas;$i++){
            $partida = $partidaController->listarPartidas($campeonato->getId(),$i);
    ?>
    <h3 id="<?= $i+1 ?>" class="mt-2">Rodada <?= $i+1 ?></h3>

    <table class="table">       
        <?php foreach($partida as $key => $row){ 
            $casa = $equipeController->listarPorId($row->getTimeCasa());
            $visitante = $equipeController->listarPorId($row->getTimeVisitante());

            // não mostra valores ainda não inseridos
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
                <input type="hidden" name="idpartida" value="<?= $row->getId() ?>" class="rodada<?=$i?>">
                <input type="hidden" name="equipecasa" value="<?= $row->getTimeCasa() ?>" class="rodada<?=$i?>">
                <input type="hidden" name="equipevisitante" value="<?= $row->getTimeVisitante() ?>" class="rodada<?=$i?>">
                <input type="hidden" name="statuspartida" value="<?= $row->getStatus() ?>">

                <td class="text-right"><?= $casa->getNome() ?></td>
                <td class="text-center" style="width: 15%;">
                    <input type="text" name="casa" style="text-align: center" maxlength="2" size="1" value="<?= $mandante ?>" autocomplete="off" class="rodada<?=$i?>">
                        x 
                    <input type="text" name="visitante" style="text-align: center" maxlength="2" size="1" value="<?= $fora ?>" autocomplete="off" class="rodada<?=$i?>">
                </td>
                <td class="text-left"><?= $visitante->getNome() ?></td>
                <td><input type="submit" value="Gravar"></td>
            </form>
        </tr>
        <?php } ?>

        <button class="btn btn-success" onclick="teste<?=$i?>()"><i class="fa fa-check-circle"></i> Enviar toda a categoria</button>
        <script>

            function teste<?=$i?>(){
                const arr = $('.rodada<?=$i?>');
                let partidas = [];
                let idPartidaAtual;

                for (let i = 0; i < arr.length; i++) {
                // for (let i = 0; i < arr.length; i++) {                
                    const campo = arr[i];

                    if (campo.name === 'idpartida') {
                        partidas[campo.value] = {
                            equipecasa: undefined,
                            equipevisitante: undefined,
                            casa: undefined,
                            visitante: undefined
                        };
                        idPartidaAtual = campo.value;
                    }
                    else if (campo.name === 'equipecasa') {
                        partidas[idPartidaAtual].equipecasa = campo.value;
                    }
                    else if (campo.name === 'equipevisitante') {
                        partidas[idPartidaAtual].equipevisitante = campo.value;
                    }
                    else if (campo.name === 'casa') {
                        partidas[idPartidaAtual].casa = campo.value;
                    }
                    else if (campo.name === 'visitante') {
                        partidas[idPartidaAtual].visitante = campo.value;
                    }
                }

               /* for(var j = 0; j < partidas.length; j++){
                    if(!partidas[j]){
                        partidas = partidas.slice(j);
                    }
                }
                */
                console.log(partidas);

                $.ajax({
                type: "POST",
                url: "./api.php?idRodada=<?=$i?>",
                data: JSON.stringify(partidas),
                success: alert('deu certo!!!!!!!!!!!!!'),
                dataType: 'json',
                contentType: "application/json"  
                });
                
            }
        </script>
    </table>
    <p>botão Executar Rodada</p>
    <a href="#0"><input type="button" class="btn btn-primary" value="Voltar Topo"></a>
    <?php } ?>
    <!-- fim impressão das rodadas -->
<?php require_once('footer.php'); ?>