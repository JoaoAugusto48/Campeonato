<?php

    require_once('../DAO/EstatisticaDAO.php');
    require_once('../Controller/PartidaController.php');

    class EstatisticaController{

        private $estatisticaDAO;
        private $partidaDAO;

        public function __construct(){
            $this->estatisticaDAO = new EstatisticaDAO;
            $this->partidaController = new PartidaController();
        }

        //Listas
        public function jogos(int $id, int $vitoria, int $empate, int $derrota):int{
            return $this->estatisticaDAO->jogos($id,$vitoria,$empate,$derrota);
        }

        public function listarPorCampeonato(int $id_campeonato):array{
            return $this->estatisticaDAO->listarPorCampeonato($id_campeonato);
        }

        //Inserir
        public function inserirEstatistica(array $idequipe, int $idcampeonato):void{
            foreach($idequipe as $equipe){
                $this->estatisticaDAO->inserirEstatistica($equipe, $idcampeonato);
            }
        }


        //Modificar
        public function average(int $vitoria,int $empate,int $derrota){
            $jogos = $vitoria+$empate+$derrota; //numero de jogos
            $pontosMax = $jogos*3; // máximo de pontos a ser conquistados
            if(!$pontosMax){
                $pontosMax = 1; // se número de rodadas = 0, então pontosMax = 1 
            }
            $avg =  ((($vitoria*3)+$empate)/$pontosMax)*100; // calculo da media
            $avg = number_format($avg,1,",","."); // formatação da pontuação
            return $avg;
        }

        public function atualizarEstatistica(int $idcampeonato,int $idpartida,bool $status,int $equipecasa,int $ngolcasa,int $equipevisitante,int $ngolvisitante):void{
            if($status){
                $estatAnterior = $this->partidaController->partidaAnterior($idpartida);
                
                if($estatAnterior->getNGolcasa() > $estatAnterior->getNGolVisitante()){
                    $this->estatisticaDAO->anteriorVitoria($idcampeonato,$estatAnterior->getTimeCasa(),$estatAnterior->getNGolCasa(),$estatAnterior->getNGolVisitante());
                    $this->estatisticaDAO->anteriorDerrota($idcampeonato,$estatAnterior->getTimeVisitante(),$estatAnterior->getNGolVisitante(),$estatAnterior->getNGolCasa());
                }
                else if($estatAnterior->getNGolVisitante() > $estatAnterior->getNGolCasa()){
                    $this->estatisticaDAO->anteriorVitoria($idcampeonato,$estatAnterior->getTimeVisitante(),$estatAnterior->getNGolVisitante(),$estatAnterior->getNGolCasa());
                    $this->estatisticaDAO->anteriorDerrota($idcampeonato,$estatAnterior->getTimeCasa(),$estatAnterior->getNGolCasa(),$estatAnterior->getNGolVisitante());
                } else {
                    $this->estatisticaDAO->anteriorEmpate($idcampeonato,$estatAnterior->getTimeCasa(),$estatAnterior->getNGolCasa(),$estatAnterior->getNGolVisitante());
                    $this->estatisticaDAO->anteriorEmpate($idcampeonato,$estatAnterior->getTimeVisitante(),$estatAnterior->getNGolVisitante(),$estatAnterior->getNGolCasa());
                }
            }
            if($ngolcasa > $ngolvisitante){
                $this->estatisticaDAO->atualizarVitoria($idcampeonato,$equipecasa,$ngolcasa,$ngolvisitante);
                $this->estatisticaDAO->atualizarDerrota($idcampeonato,$equipevisitante,$ngolvisitante,$ngolcasa);
            } 
            else if($ngolvisitante > $ngolcasa){
                $this->estatisticaDAO->atualizarVitoria($idcampeonato,$equipevisitante,$ngolvisitante,$ngolcasa);
                $this->estatisticaDAO->atualizarDerrota($idcampeonato,$equipecasa,$ngolcasa,$ngolvisitante);
            }
            else {
                $this->estatisticaDAO->atualizarEmpate($idcampeonato,$equipecasa,$ngolcasa,$ngolvisitante);
                $this->estatisticaDAO->atualizarEmpate($idcampeonato,$equipevisitante,$ngolvisitante,$ngolcasa);
            }
        }

        // --- --- --- Classificação --- --- ---
        public function classificacao(array $estatistica):array{
            // passando variaveis para pontosCalculo
            foreach($estatistica as $row){
                $row->pontosCalculo = $this->pontos($row->getId(),$row->getVitoria(),$row->getEmpate());
                $row->vitorias = $this->nVitoria($row->getId(),$row->getVitoria());
                $row->saldo = $this->saldoGol($row->getId(),$row->getGolPro(),$row->getGolContra());
                $row->golsMarcados = $this->golsMarcados($row->getId(),$row->getGolPro());
            }
            // ordenando por pontos
            usort($estatistica, function($timeA,$timeB){
                    if($timeA->pontosCalculo != $timeB->pontosCalculo){
                        return $timeA->pontosCalculo < $timeB->pontosCalculo;
                    }
                    else
                        if($timeA->saldo != $timeB->saldo){
                            return $timeA->saldo < $timeB->saldo;
                        }
                        else 
                            if($timeA->golsMarcados != $timeB->golsMarcados){
                                return $timeA->golsMarcados < $timeB->golsMarcados;
                            }else return $timeA->vitorias < $timeB->vitorias;
                });
            return $estatistica;
        }

        public function pontos(int $id,int $vitoria,int $empate):int{
            return $this->estatisticaDAO->pontos($id,$vitoria,$empate);
        }

        public function nVitoria(int $id,int $vitoria):int{
            return $this->estatisticaDAO->nVitoria($id,$vitoria);
        }

        public function saldoGol(int $id,int $golpro,int $golcontra):int{
            return $this->estatisticaDAO->saldoGol($id,$golpro,$golcontra);
        }

        public function golsMarcados(int $id,int $golpro):int{
            return $this->estatisticaDAO->golsMarcados($id,$golpro);
        }
        // --- --- --- Classificação --- --- ---

        //Deletar (logicamente)

        //Deletar

        //outros metodos
        public function listarCampeao(object $campeonato,array $classificacao){
            //criando especificando o numero de pertidas que serão jogadas por cada equipe
            $njogos = ($campeonato->getNEquipe()-1);
            if($campeonato->getTurno()){
                $njogos*=2;
            }

            $partidasJogadas = 0;
            foreach($classificacao as $equipe){
                $jogados = $this->jogos($equipe->getId(),$equipe->getVitoria(),$equipe->getEmpate(),$equipe->getDerrota());
                if($jogados != $njogos){
                    $partidasJogadas++;
                }
            }
            if($partidasJogadas==0){
                return $classificacao[0]->getIdEquipe();
            }else return 0;
        }


    }

?>