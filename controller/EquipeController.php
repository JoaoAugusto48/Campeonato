<?php

    require_once('../DAO/EquipeDAO.php');

    class EquipeController{
        
        private $equipeDAO;

        public function __construct(){
            $this->equipeDAO = new EquipeDAO();
        }

        //Listas
        public function listarNome():array{
            return $this->equipeDAO->listarPorNome();
        }

        //Inserir
        public function insEquipe(string $nome, string $sigla, string $idPais):void{
            $sigla = strtoupper($sigla);
            $this->equipeDAO->insEquipe($nome, $sigla, $idPais);
        }

        public function listarPorId(int $id){
            return $this->equipeDAO->listarPorId($id);
        }

        //Modificar
        public function editarEquipe(int $id, string $nome, string $sigla, string $idPais):void{
            $sigla = strtoupper($sigla);
            $this->equipeDAO->editarEquipe($id, $nome, $sigla, $idPais);
        } 
        //Deletar (logicamente)

        //Deletar
    }


?>