<?php
    // site de validação javascript
    //http://www.criarweb.com/artigos/validacao-formulario-com-javascript.html

    $n = 10;
    $time = array(
        0 => 'Corinthians', 
        1 => 'São Paulo', 
        2 => 'Santos', 
        3 => 'Palmeiras', 
        4 => 'Vasco', 
        5 => 'Chapecoense',
        6 => 'Coritiba',
        7 => 'Internacional',
        8 => 'Juventude',
        9 => 'Grêmio'
    );
    //var_dump($time);

    //recebendo valores do checkbox
    if(isset($_POST['time'])){
        $array = $_POST['time'];
        $returno = isset($_POST['returno']) ? true : false;
        //var_dump($returno);
        $max = count($array); 
        foreach($array as $row){
            echo $row . '<br/>';
        }
        echo '<br/>';
    }
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
    <form action="teste.php" method="post">
        <table>   
            <?php for($i=0; $i<$n; $i++) { ?>
                <tr>
                    <td><input type="checkbox" name="time[]" id="<?= $i ?>" value="<?= $time[$i] ?>"><?= $time[$i] ?></td>
                </tr>
            <?php } ?>
        </table>
        <br><br>
        <input type="checkbox" name="returno">Segundo Turno<br/>
        <input type="submit" value="Enviar">
    </form>

    <?php 
        if(isset($array)){
            rodadas($array, $max, $returno);
        }
        else {rodadas($time, $n, false);} 
    ?>
</body>
</html>

<?php
    function rodadas(array $time, int $n, bool $returno):void{
        shuffle($time);

        if($n%2 != 0){
            $time[$n] = null;
            $n++;
        }
        //imprimindo cada rodada do campeonato
        for($y=0; $y<($n-1); $y++){
            Jogos($time,$n,$y);
            // reordenando a lista para os confrontos
            $time = ReordenarListaJogos($time,$n);
        }
        //var_dump($returno);
        if($returno){
            for($y=$n-1; $y<($n-1)*2; $y++){
                JogosReturno($time,$n,$y);
                // reordenando a lista para os confrontos
                $time = ReordenarListaJogos($time,$n);
            }
        }
    }

    function Jogos(array $time, int $n, int $y){
        NumeroRodada($y);
        echo '<table>';
        for($i=0, $j=($n-1); $i<(int)($n/2); $i++, $j--){ //for de impressão das rodas
            if(($time[$i] && $time[$j]) != ''){
                if($y%2 == 0 && $i == 0)
                    Partida($time[$j],$j,$time[$i],$i);
                else if($i%2 == 0)
                    Partida($time[$i],$i,$time[$j],$j);
                    else 
                        Partida($time[$j],$j,$time[$i],$i);
            } else EquipeAusente($time[$i],$time[$j]);
        }
        echo '</table>';
    }

    function JogosReturno(array $time, int $n, int $y){
        NumeroRodada($y);
        echo '<table>';
        for($i=0, $j=($n-1); $i<(int)($n/2); $i++, $j--){
            if(($time[$i] && $time[$j]) != ''){
                if($y%2 != 0 && $i == 0)
                    Partida($time[$i],$i,$time[$j],$j);
                else if($i%2 == 0)
                    Partida($time[$j],$j,$time[$i],$i);
                    else 
                        Partida($time[$i],$i,$time[$j],$j);
            } else EquipeAusente($time[$i],$time[$j]);
        }
        echo '</table>';
    }

    function EquipeAusente($casa, $fora){
        if($casa != '') {
            $semjogo = $casa;
        }else {$semjogo = $fora;}
        echo '<br> <b>'. $semjogo . '</b> não joga essa rodada<br>';
    }

    function NumeroRodada($y){
        echo '<h3>Rodada ' . ($y+1) . '</h3>';
    }

    function ReordenarListaJogos(array $time, int $n):array{
        $aux = $time[$n-1];
        for($i=$n-1; $i>0; $i--){
            $time[$i] = $time[$i-1];
        }
        $time[1] = $aux;
        return $time;
    }

    function Partida(string $casa, int $i, string $visitante, int $j){
        echo '
            <tr>
                <td align="right">' . $casa. "</td>
                <td>
                    <input type='text' name= ".$i." id=".$i." style='text-align: center' maxlength='2' size='1'>" 
                    . ' x ' . 
                    " <input type='text' name=".$j." id=".$j." style='text-align: center' maxlength='2' size='1'>
                </td>
                <td>" . $visitante .'</td>
            </tr>
            ';
    }
?>