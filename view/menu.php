<<<<<<< HEAD
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
    <table>
        <tr>
            <th>Campeonato</th>
            <th>Equipes</th>
            <th>Rodadas</th>
            <th>Turno</th>
        </tr>
        <?php foreach($campeonato as $row) { ?>
        <tr>
            <td>
                <input type="button" value="<?= $row->getNome() ?>" onclick="javascript: location.href='lstEstatistica?id=<?= $row->getId() ?>'">
            </td>
            <td>E: <?= $row->getNEquipe() ?></td>
            <td>R: <?= $campeonatoController->numeroRodadas($row->getNEquipe(),$row->getTurno()) ?></td>
            <td>T: <?= $campeonatoController->condicaoTurno($row->getTurno()) ?></td>
        </tr>
        <?php } ?>
    </table>


<?php require_once('footer.php'); ?>
=======
<?php
    require_once('../controller/CampeonatoController.php');
   $campeonatoController = new CampeonatoController();
   
   $campeonato = $campeonatoController->listarCampeonato();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Página Principal</title>
    </head>
    <body>
        <h1>Campeonato</h1>

        <input type="button" value="Equipes" onclick="javascript: location.href='lstEquipe'">
        <input type="button" value="Países" onclick="javascript: location.href='lstPais'">
        <input type="button" value="Novo Campeonato" onclick="javascript: location.href='frmInsCampeonato'">

        <hr>
        <h3>Campeonatos recorrentes</h3>
        <table>
            <tr>
                <th>Campeonato</th>
                <th>Equipes</th>
                <th>Rodadas</th>
                <th>Turno</th>
            </tr>
            <?php foreach($campeonato as $row) { ?>
            <tr>
                <td>
                    <input type="button" value="<?= $row->getNome() ?>" onclick="javascript: location.href='lstEstatistica?id=<?= $row->getId() ?>'">
                </td>
                <td>E: <?= $row->getNEquipe() ?></td>
                <td>R: <?= $campeonatoController->numeroRodadas($row->getNEquipe(),$row->getTurno()) ?></td>
                <td>T: <?= $campeonatoController->condicaoTurno($row->getTurno()) ?></td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
>>>>>>> 04f6116eb9f2ad714e84a935ae8d64e67a8b762a
