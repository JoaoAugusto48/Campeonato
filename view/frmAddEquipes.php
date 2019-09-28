<?php
    require_once('../controller/EquipeController.php');
    require_once('../controller/CampeonatoController.php');
    require_once('../controller/EstatisticaController.php');
    
    $equipeController = new EquipeController();
    $campeonatoController = new CampeonatoController();
    
    $id_campeonato = $_GET['id']; // id do campeonato
    
    // valores para envio de dados
    if(isset($_POST['chkId'])){
        $estatisticaController = new EstatisticaController();

        $equipes = $_POST['chkId'];
        $estatisticaController->inserirEstatistica($equipes,$id_campeonato);
        header('Location: menu');
        die();
    }

    $equipe = $equipeController->listarNome();
    $campeonato = $campeonatoController->listarId($id_campeonato);

    //valor usado para função em javascript
    $valor = $campeonato->getNEquipe();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $campeonato->getNome() ?> - Adicionar Times</title>
    </head>
    <body>
        <h2><?= $campeonato->getNome() ?> - Seleção de Equipes</h2>
        <hr>
        <p>Países a selecionar: <span id='total'><?= $valor ?></span>/<?= $campeonato->getNEquipe() ?></p>
        <input type="button" value="Voltar" onclick="javascript: location.href='frmInsCampeonato'">Excluir esse botão
        <form action="frmAddEquipes?id=<?= $id_campeonato ?>" method="post" id="frmInsCampeonato" name="frmInsCampeonato">
        <table>
            <tr>
                <th>*</th>
                <th>NOME</th>
                <th>SIGLA</th>
                <th>PAIS</th>
            </tr>
            <?php foreach($equipe as $row) { ?>
            <tr>
                <td><input type="checkbox" name="chkId[]" value="<?= $row->getId() ?>" onclick="getItensSel()"></td>
                <td><?= $row->getNome() ?></td>
                <td><?= $row->getSigla() ?></td>
                <td><?= $row->getPais()->getNome() ?></td>
            </tr>
            <?php } ?>

            <input type="submit" value="Enviar" onclick="validarSubmit()">
        </form>
    </body>
</html>


<script>
var d = document;
function $( bloco )
{
    return d.getElementById( bloco );
}

function getItensSel()
{
    itens = <?= $valor ?>;
    var oElementos = d.getElementsByTagName('input');
    for( var i = 0; i < oElementos.length; i++ )
    {
        if( oElementos[ i ].type == 'checkbox' )
        {
           if( oElementos[ i ].checked )
           {
              itens--;
           }
        }
    }   
    $( 'total' ).innerHTML = itens;
}

function validarSubmit(event){
    // Previnir comportamento padrão
    event.preventDefault();

    // Pegando valor do input
    var value = getItensSel();
    
    // fazer validação em caso esteja OK
    if(value.length != 0)
        alert('Não é possível ser enviado, pois o valor é diferente do declarado');
    else{
        alert('Formulário enviado');
        form.submit();
    }
}
</script>