<?php

    class Usuario{
        private $id;
        private $nome;
        private $user;
        private $senha;

        //GETs
        public function getId():int{
            return $this->id;
        }

        public function getNome():string{
            return $this->nome;
        }

        public function getUser():string{
            return $this->user;
        }

        public function getSenha():string{
            return $this->senha;
        }

        //SETs
        public function setId(int $id):void{
            $this->id = $id;
        }

        public function setNome(string $nome):void{
            $this->nome = $nome;
        }

        public function setUser(string $user):void{
            $this->user = $user;
        }
        
        public function setSenha(string $senha):void{
            $this->senha = $senha;
        }
    }

?>