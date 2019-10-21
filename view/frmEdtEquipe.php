<?php
    require_once('../controller/EquipeController.php');
    require_once('../controller/PaisController.php');
    //Acesso a página
    if(isset($_GET['id'])){
        $id = trim($_GET['id']);
        
        $paisController = new PaisController();
        $pais = $paisController->listarPais();

        $equipeController = new EquipeController();
        $equipe = $equipeController->listarPorId($id);
        $idDoPais = $equipe->getIdPais();
    }

    if(isset($_POST['txtId']) && isset($_POST['txtNome']) && isset($_POST['txtSigla']) && isset($_POST['idPais'])){
        $id = $_POST['txtId'];
        $nome = $_POST['txtNome'];
        $sigla = $_POST['txtSigla'];
        $idpais = $_POST['idPais'];
        
        $equipeController = new EquipeController();
        $equipeController->editarEquipe($id, $nome,$sigla,$idpais);
        header('Location: lstEquipe');
        die();
    }

    $titulo = 'Editar Equipe';
    require_once('header.php');
 ?>

    <h2>Edicação da Equipe</h2>
    <hr/>
    <input type="button" value="Voltar" onclick="javascript: location.href='lstEquipe'">
    <form name="fequipe" action="frmEdtEquipe" method="POST">
        <div>
            <label for="lblId">Id: <?= $equipe->getId() ?></label>
            <input type="hidden" name="txtId" id="txtId" value="<?= $equipe->getId() ?>">
        </div>
        <div>
            <label for="lblNome">Equipe: </label>
            <input type="text" name="txtNome" id="txtNome" value="<?= $equipe->getNome() ?>" placeholder="Nome da Equipe" autocomplete="off">
        </div>
        <div>
            <label for="lblSigla">Sigla: </label>
            <input type="text" name="txtSigla" id="txtSigla" value="<?= $equipe->getSigla() ?>" maxlength="4" size="3" placeholder="Sigla da Equipe" autocomplete="off">
        </div>
        <div>
            <label for="lblPais">País: </label>
            <select name="idPais">
                <?php foreach($pais as $row) {
                    if($row->getId() == $equipe->getIdPais()) {
                ?>           
                <option value="<?= $row->getId() ?>" selected><?= $row->getNome() ?></option>
                <?php } else { ?>
                    <option value="<?= $row->getId() ?>" ><?= $row->getNome() ?></option>;
                <?php } 
                } ?>
            </select>
        </div>
        <input type="button" value="Editar" onclick="valida_equipe()">
    </form>

    <script type="text/javascript" src="js/Equipe.js"></script>

<?php require_once('footer.php'); ?>