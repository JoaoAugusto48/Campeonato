<?php

    require_once('../DAO/EstatisticaDAO.php');

    class EstatisticaController{

        private $estatisticaDAO;

        public function __construct(){
            $this->estatisticaDAO = new EstatisticaDAO;
        }

        //Listas
        public function listarPorCampeonato(int $id):array{
            return $this->estatisticaDAO->listarPorCampeonato($id);
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