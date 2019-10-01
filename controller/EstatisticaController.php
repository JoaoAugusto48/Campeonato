<?php

    require_once('../DAO/EstatisticaDAO.php');

    class EstatisticaController{

        private $estatisticaDAO;

        public function __construct(){
            $this->estatisticaDAO = new EstatisticaDAO;
        }

        //Listas
        public function Jogos(int $id, int $vitoria, int $empate, int $derrota):int{
            return $this->estatisticaDAO->Jogos($id,$vitoria,$empate,$derrota);
        }

        public function Pontos(int $id, int $vitoria, int $empate):int{
            return $this->estatisticaDAO->Pontos($id,$vitoria,$empate);
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

        //Deletar (logicamente)

        //Deletar
    }

?>