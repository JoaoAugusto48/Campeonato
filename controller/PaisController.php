<?php

    require_once('../DAO/PaisDAO.php');
    require_once('UsuarioController.php');

    $usuario = new UsuarioController();
    $usuario->sessao();

    class PaisController{

        private $paisDAO;

        public function __construct(){
            $this->paisDAO = new PaisDAO();
        }
        
        //Listas
        public function listarPais():array{
            return $this->paisDAO->listarPorNome();
        }
        //para classificar a tabela dos registros
        public function listarId():array{
            return $this->paisDAO->listarPorId();
        }

        //Adicionar
        public function addPais(string $nome):void{
            $this->paisDAO->inserirPais($nome);
        }
        
        //Editar - listar
        public function selecionarPais(int $id):Pais{
            return $this->paisDAO->selecionarPais($id);
        }
        //Editar
        public function edtPais(int $id, string $nome):void{
            $this->paisDAO->edtPais($id,$nome);
        }

        //Remover 

        //Remover Lógicamente
        public function remLogPais(int $id):void{
            $this->paisDAO->remLogPais($id);
        }
    }
?>