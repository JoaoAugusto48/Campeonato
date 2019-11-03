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

    $titulo = 'Editar - '. $equipe->getNome();
    require_once('header.php');
 ?>
    <div class="jumbotron bg-white py-4">
        <h2>Editar - <?= $equipe->getNome() ?></h2>
        <hr class="bg-dark"/>
        <input type="button" value="Voltar" onclick="javascript: location.href='lstEquipe'">
        <div class="row justify-content-center">
            <div class="col-md-11 mt-2">
                <div class="jumbotron bg-secondary pt-5 pb-3 border border-white text-white font-weight-bold">
                    <form name="fequipe" action="frmEdtEquipe" method="POST">
                        <div class="form-group row">
                            <label for="lblId" class="col-md-1 col-form-label text-right">ID</label>
                            <div class="col-md-10">
                                <input type="hidden" name="txtId" id="txtId" value="<?= $equipe->getId() ?>">
                                <input type="text" class="form-control" value="<?= $equipe->getId() ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lblNome" class="col-md-1 col-form-label text-right">Equipe</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="txtNome" value="<?= $equipe->getNome() ?>" placeholder="Nome da Equipe" maxlength="30" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lblSigla" class="col-md-1 col-form-label text-right">Sigla</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="txtSigla" value="<?= $equipe->getSigla() ?>" placeholder="Sigla" maxlength="4" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lblPais" class="col-md-1 col-form-label text-right">País</label>
                            <div class="col-md-10">
                                <select name="idPais" class="form-control">
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
                        </div>
                        <div class="form-group offset-md-1">
                            <input type="button" class="center-block btn btn-outline-light" value="Editar" onclick="valida_equipe()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="jumbotron bg-white py-4">
        <h2>Editar - <?= $equipe->getNome() ?></h2>
        <hr class="bg-dark">
        <input type="button" class="btn btn-info" value="Voltar" onclick="javascript: location.href='lstEquipe'">    
        <div class="row justify-content-center">
            <div class="col-md-11 mt-2">
                <div class="jumbotron bg-secondary pt-5 pb-3 border border-white text-white font-weight-bold">
                    <form name="fequipe" action="frmEdtEquipe" method="POST">
                        <div class="form-group row">
                            <label for="lblId" class="col-md-1 col-form-label text-right">Id</label>
                            <div class="col-md-10">
                                <input type="text" name="txtId" value="<?= $equipe->getId() ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lblNome" class="col-md-1 col-form-label text-right">Equipe</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="txtNome" value="<?= $equipe->getNome() ?>" placeholder="Nome da Equipe" maxlength="30" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lblSigla" class="col-md-1 col-form-label text-right">Sigla</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="txtSigla" value="<?= $equipe->getSigla() ?>" placeholder="Sigla" maxlength="4" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lblPais" class="col-md-1 col-form-label text-right">País</label>
                            <div class="col-md-10">
                                <select name="idPais" class="form-control">
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
                        </div>
                        <div class="form-group offset-md-1">
                            <input type="button" class="center-block btn btn-outline-light" value="Editar" onclick="valida_equipe()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->


    <script type="text/javascript" src="js/Equipe.js"></script>

<?php require_once('footer.php'); ?>