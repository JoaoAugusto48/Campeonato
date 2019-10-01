<<<<<<< HEAD
<?php
    require_once('../controller/EstatisticaController.php');
    require_once('../controller/CampeonatoController.php');

    $id_campeonato = $_GET['id'];

    $estatisticaController = new EstatisticaController();
    $campeonatoController = new CampeonatoController();    
    
    $estatistica = $estatisticaController->listarPorCampeonato($id_campeonato);
    $campeonato = $campeonatoController->listarId($id_campeonato);
    //var_dump($estatistica);
    
    $titulo = $campeonato->getNome();
    require_once('header.php');
?>

    <h2><?= $campeonato->getNome() ?></h2>
    <hr>
    <input type="button" value="Voltar" onclick="javascript: location.href='menu'">
    <input type="button" value="Jogos" onclick="javascript: location.href='lstJogos?id=<?= $id_campeonato ?>'">
    <br><br>
    <table>
        <tr>
            <th>#</th>
            <th>NOME</th>
            <th>JOGOS</th>
            <th>VITORIA</th>
            <th>EMPATE</th>
            <th>DERROTA</th>
            <th>GOLS</th>
            <th>PONTOS</th>
        </tr>
        <?php 
            // passando variaveis para pontosCalculo
            foreach($estatistica as $row){
                $row->pontosCalculo = $estatisticaController->Pontos($row->getId(),$row->getVitoria(),$row->getEmpate());
            }

            // ordenando por pontos
           usort($estatistica, function($timeA,$timeB){
                return $timeA->pontosCalculo < $timeB->pontosCalculo; 
            });

            $i=1; foreach($estatistica as $row) { 
        ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $row->getEquipe()->getNome() ?></td>
            <td><?= $estatisticaController->Jogos($row->getId(),$row->getVitoria(),$row->getEmpate(),$row->getDerrota()) ?></td>
            <td><?= $row->getVitoria() ?></td>
            <td><?= $row->getEmpate() ?></td>
            <td><?= $row->getDerrota() ?></td>
            <td>
                <?= $row->getGolPro() ?>/<?= $row->getGolContra() ?>
            </td>
            <td><?= $row->pontosCalculo ?></td>
        </tr>
        <?php $i++; } ?>
    </table>

<?php require_once('footer.php'); ?>
=======
<?php
    require_once('../controller/EstatisticaController.php');

    $id_Campeonato = $_GET['id'];

    $estatisticaController = new EstatisticaController();
    $estatistica = $estatisticaController->listarPorCampeonato($id_Campeonato);
    var_dump($estatistica);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
    <input type="button" value="Voltar" onclick="javascript: location.href='menu'">
    <input type="button" value="Inserir Equipe" onclick="javascript: location.href='menu'">
        <br><br>
        <table>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>VITORIA</th>
                <th>EMPATE</th>
                <th>DERROTA</th>
            </tr>
            <?php foreach($estatistica as $row) { ?>
            <tr>
                <td><?= $row->getId() ?></td>
                <td><?= $row->getIdEquipe() ?></td>
                <td><?= $row->getVitoria() ?></td>
                <td><?= $row->getEmpate() ?></td>
                <td><?= $row->getDerrota() ?></td>
                <th>
                    <input type="button" value="Editar" onclick="javascript: location.href='frmEdtEquipe?id='+<?= $row->getId() ?>">
                    <input type="button" value="Remover">
                </th>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
>>>>>>> 04f6116eb9f2ad714e84a935ae8d64e67a8b762a
