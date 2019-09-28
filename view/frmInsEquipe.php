<?php
    require_once('../controller/EquipeController.php');
    require_once('../controller/PaisController.php');

    $paisController = new PaisController();
    $pais = $paisController->listarPais();

    if(isset($_POST['txtNome']) && isset($_POST['txtSigla']) && isset($_POST['idPais'])){
        $nome = $_POST['txtNome'];
        $sigla = $_POST['txtSigla'];
        $idpais = $_POST['idPais'];
        $equipe = new EquipeController();
        $equipe->insEquipe($nome,$sigla,$idpais);
        header('Location: lstEquipe');
        die();
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Inserir Equipe</title>
    </head>
    <body>
        <h2>Cadastrar nova Equipe</h2>
        <hr/>
        <input type="button" value="Voltar" onclick="javascript: location.href='lstEquipe'">
        <form id="frmInsEquipe" name="frmInsEquipe" action="frmInsEquipe" method="POST">
            <div>
                <label for="lblNome">Equipe</label>
                <input type="text" name="txtNome" id="txtNome" placeholder="Nome da Equipe" autocomplete="off">
            </div>
            <div>
                <label for="lblSigla">Sigla</label>
                <input type="text" name="txtSigla" id="txtSigla" placeholder="Sigla da Equipe" autocomplete="off">
            </div>
            <div>
                <label for="lblPais">País</label>
                <select name="idPais">
                    <?php
                        foreach($pais as $row){
                            echo "<option value=". $row->getId() .">". $row->getNome() ."</option>";
                        }
                    ?>
                </select>
            </div>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>