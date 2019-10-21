<?php
    require_once('../controller/CampeonatoController.php');
   $campeonatoController = new CampeonatoController();
   
   $campeonato = $campeonatoController->listarCampeonato();
   
   $titulo = 'Página Principal';
   require_once('header.php');
?>
    
    <h1>Campeonato</h1>

    <input type="button" value="Equipes" onclick="javascript: location.href='lstEquipe'">
    <input type="button" value="Países" onclick="javascript: location.href='lstPais'">
    <input type="button" value="Novo Campeonato" onclick="javascript: location.href='frmInsCampeonato'">

    <hr>
    <h3>Campeonatos recorrentes</h3>
    <table class="table table-striped table-hover bg-secondary text-white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Campeonato</th>
                <th scope="col">Equipes</th>
                <th scope="col">Rodadas</th>
                <th scope="col">Turno</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($campeonato as $row) { ?>
            <tr>
                <td scope="row">
                    <input type="button" value="<?= strip_tags($row->getNome()) ?>" onclick="javascript: location.href='lstEstatistica?id=<?= $row->getId() ?>'">
                </td>
                <td scope="row">E: <?= $row->getNEquipe() ?></td>
                <td scope="row">R: <?= $campeonatoController->numeroRodadas($row->getNEquipe(),$row->getTurno()) ?></td>
                <td scope="row">T: <?= $campeonatoController->condicaoTurno($row->getTurno()) ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

<?php require_once('footer.php'); ?>