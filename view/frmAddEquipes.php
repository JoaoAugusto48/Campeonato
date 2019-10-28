<?php
    require_once('../controller/EquipeController.php');
    require_once('../controller/CampeonatoController.php');
    require_once('../controller/EstatisticaController.php');
    require_once('../controller/PartidaController.php');
    
    $equipeController = new EquipeController();
    $campeonatoController = new CampeonatoController();
    
    $id_campeonato = $_GET['id']; // id do campeonato
    
    // valores para envio de dados
    if(isset($_POST['chkId'])){
        $estatisticaController = new EstatisticaController();

        $equipes = $_POST['chkId'];
        $estatisticaController->inserirEstatistica($equipes,$id_campeonato);
        // a cima inserido as estatisticas docampeonato -- abaixo inserindo as partidas do mesmo

        $partidaController = new PartidaController();
        $campeonatoController = new CampeonatoController();
        
        $campeonato = $campeonatoController->listarId($id_campeonato);
        
        $nequipes = count($equipes);
        $partidaController->criarPartida($equipes,$nequipes,$id_campeonato,$campeonato->getTurno());

        header('Location: lstEstatistica?id='.$id_campeonato);
        die();
    }

    $equipe = $equipeController->listarNome();
    $campeonato = $campeonatoController->listarId($id_campeonato);

    //valor usado para função em javascript
    $valor = $campeonato->getNEquipe();


    $titulo = $campeonato->getNome();
    require_once('header.php');
 ?>

    <h2><?= $campeonato->getNome() ?> - Seleção de Equipes</h2>
    <hr>
    <p class="font-weight-bold">Países a selecionar: <span id='total'><?= $valor ?></span>/<?= $campeonato->getNEquipe() ?></p>
    <input type="button" class="btn btn-info" value="Voltar" onclick='javascript:history.back()'>
    <form action="frmAddEquipes?id=<?= $id_campeonato ?>" method="post" id="frmInsCampeonato" name="fvalida">
    <table class="table table-striped text-center mt-1">
        <thead class="thead-dark">
            <tr>
                <th>*</th>
                <th>NOME</th>
                <th>SIGLA</th>
                <th>PAIS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($equipe as $row) { ?>
            <tr>
                <td><input type="checkbox" name="chkId[]" value="<?= $row->getId() ?>" onclick="getItensSel(<?= $valor ?>)"></td>
                <td><?= $row->getNome() ?></td>
                <td><?= $row->getSigla() ?></td>
                <td><?= $row->getPais()->getNome() ?></td>
            </tr>
            <?php } ?>
        </tbody>
        <input type="button" class="btn btn-outline-success mt-1" value="Enviar" onclick="valida_estatistica()">
    </form>

    <script type="text/javascript" src="js/Estatistica.js"></script>

<?php require_once('footer.php'); ?>