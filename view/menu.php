<?php
    require_once('../controller/CampeonatoController.php');
   $campeonatoController = new CampeonatoController();
   
   $campeonato = $campeonatoController->listarCampeonato();
   
   $titulo = 'Página Principal';
   require_once('header.php');
?>

    <h1 class="text-dark">Campeonato</h1>

    <input type="button" class="btn btn-info" value="Equipes" onclick="javascript: location.href='lstEquipe'">
    <input type="button" class="btn btn-info" value="Países" onclick="javascript: location.href='lstPais'">
    <input type="button" class="btn btn-info" value="Novo Campeonato" onclick="javascript: location.href='frmInsCampeonato'">
    
    <hr class="bg-secondary">
    <h3>Campeonatos recorrentes</h3>
    <table class="table table-striped table-hover bg-light">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">Campeonato</th>
                <th scope="col" class="text-center">Equipes</th>
                <th scope="col" class="text-center">Rodadas</th>
                <th scope="col" class="text-center">Turno</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($campeonato as $row) { ?>
            <tr>
                <td scope="row" class="text-center">
                    <input type="button" class="btn btn-outline-dark" value="<?= strip_tags($row->getNome()) ?>" onclick="javascript: location.href='lstEstatistica?id=<?= $row->getId() ?>'">
                </td>
                <td scope="row" class="text-center">E: <?= $row->getNEquipe() ?></td>
                <td scope="row" class="text-center">R: <?= $campeonatoController->numeroRodadas($row->getNEquipe(),$row->getTurno()) ?></td>
                <td scope="row" class="text-center">T: <?= $campeonatoController->condicaoTurno($row->getTurno()) ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>


<?php require_once('footer.php'); ?>