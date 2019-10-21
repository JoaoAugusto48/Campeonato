<?php

    require_once('../DAO/PartidaDAO.php');

    class PartidaController{

        private $partidaDAO;

        public function __construct(){
            $this->partidaDAO = new PartidaDAO;
        }

        //Listas
        public function listarPartidas(int $idcampeonato,int $rodada):array{
            return $this->partidaDAO->listarPartidas($idcampeonato,$rodada);
        }

        public function partidaAnterior(int $idpartida):object{
            return $this->partidaDAO->partidaAnterior($idpartida);
        }

        // public function equipeAusente(int $equipeA,int $equipeB){
        //     if($equipeA != '') {
        //         $semjogo = $equipeA;
        //     }else {$semjogo = $equipeB;}
        //     //echo '<br> <b>'. $semjogo . '</b> não joga essa rodada<br>';
        //     return $semjogo;
        // } 

        //Inserir
        public function criarPartida(array $equipes,int $nequipe,int $idcampeonato,bool $returno):void{
            //int $rodada,int $timecasa,int $timevisitante;
            shuffle($equipes);

            if($nequipe%2 != 0){
                $equipes[$nequipe] = null;
                $nequipe++;
            }
            //criando cada rodada do campeonato
            for($rodada=0;$rodada<($nequipe-1);$rodada++){
                $this->jogos($equipes,$nequipe,$rodada,$idcampeonato);
                $equipes = $this->reordenarArrayEquipes($equipes,$nequipe);
            }
            if($returno){
                for($rodada=$nequipe-1;$rodada<($nequipe-1)*2;$rodada++){
                    $this->jogosReturno($equipes,$nequipe,$rodada,$idcampeonato);
                    $equipes = $this->reordenarArrayEquipes($equipes,$nequipe);
                }
            }

        }

        //Modificar
        public function resultadoPartida(int $idcampeonato,int $id,int $ngolcasa,int $ngolvisitante):void{
            $this->partidaDAO->resultadoPartida($idcampeonato,$id,$ngolcasa,$ngolvisitante);
        }

        //Operações

        private function jogos(array $equipes,int $nequipe,int $rodada,int $idcampeonato):void{
            // $i - equipes que estãp do início até o meio do vetor
            // $j - as equipes que estão do meio ao fim do vetor
            for($i=0, $j=($nequipe-1); $i<(int)($nequipe/2); $i++, $j--){
                if(($equipes[$i] && $equipes[$j]) != ''){
                    if($rodada%2 == 0 && $i == 0)
                        $this->inserirPartida($idcampeonato,$rodada,$equipes[$j],$equipes[$i]);
                    else if($i%2 == 0)
                        $this->inserirPartida($idcampeonato,$rodada,$equipes[$i],$equipes[$j]);
                        else 
                            $this->inserirPartida($idcampeonato,$rodada,$equipes[$j],$equipes[$i]);
                } 
            }
        }

        private function jogosReturno(array $equipes,int $nequipe,int $rodada,int $idcampeonato):void{
            // $i - equipes que estãp do início até o meio do vetor
            // $j - as equipes que estão do meio ao fim do vetor
            for($i=0, $j=($nequipe-1); $i<(int)($nequipe/2); $i++, $j--){
                if(($equipes[$i] && $equipes[$j]) != ''){
                    if($rodada%2 != 0 && $i == 0)
                        $this->inserirPartida($idcampeonato,$rodada,$equipes[$i],$equipes[$j]);
                    else if($i%2 == 0)
                        $this->inserirPartida($idcampeonato,$rodada,$equipes[$j],$equipes[$i]);
                        else 
                            $this->inserirPartida($idcampeonato,$rodada,$equipes[$i],$equipes[$j]);
                }
            }
        }

        private function inserirPartida(int $idcampeonato,int $rodada,int $idcasa,int $idvisitante):void{
            $this->partidaDAO->CriarPartida($idcampeonato,$rodada,$idcasa,$idvisitante);
        }

        private function reordenarArrayEquipes(array $equipes, int $nequipe):array{
            $aux = $equipes[$nequipe-1];
            for($i=$nequipe-1; $i>0; $i--){
                $equipes[$i] = $equipes[$i-1];
            }
            $equipes[1] = $aux;
            return $equipes;
        }
    }

?>