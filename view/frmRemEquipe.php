<?php
    require_once('../controller/EquipeController.php');

    if(isset($_GET['id'])){
        $id_equipe = $_GET['id'];

        $equipeController = new EquipeController();
        $equipe = $equipeController->listarPorId($id_equipe);
    }
    if(isset($_POST['txtNome'])){
        $id_equipe = $_POST['txtId'];
        var_dump($id_equipe);
        $equipeController = new EquipeController();
        $equipeController->removerEquipe($id_equipe);
        header('Location: lstEquipe');
        die();
    }

    $titulo = $equipe->getNome();
    require_once('header.php');
?>
    <h2>Remover - <?= $equipe->getNome() ?></h2>
    <hr/>
    <input type="button" value="Voltar" onclick="javascript: location.href='lstEquipe'">
    <form id="frmRemEquipe" name="frmRemEquipe" action="frmRemEquipe?id=<?= $id_equipe ?>" method="POST">
    <div>
            <label for="lblNome">Equipe: <?= $equipe->getId() ?></label>
            <input type="hidden" name="txtId" value="<?= $equipe->getId() ?>">
        </div>
        <div>
            <label for="lblNome">Equipe: <?= $equipe->getNome() ?></label>
            <input type="hidden" name="txtNome" value="<?= $equipe->getNome() ?>">
        </div>
        <div>
            <label for="lblSigla">Sigla: <?= $equipe->getSigla() ?></label>
        </div>
        <div>
            <label for="lblPais">País: <?= $equipe->getPais()->getNome() ?></label>
        </div>
        <input type="submit" value="Remover">
    </form>


<?php require_once('footer.php'); ?>