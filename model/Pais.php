<?php

    class Pais{
        private $id;
        private $nome;
        private $status; // false = excuidos logicamente / - / true = existentes

        //GETs
        public function getId():int{
            return $this->id;
        }

        public function getNome():string{
            return $this->nome;
        }

        public function getStatus():bool{
            return $this->status;
        }

        //SETs
        public function setId(int $id): void{
            $this->id = $id;
        }

        public function setNome(string $nome): void{
            $this->nome = $nome;
        }

        public function setStatus(bool $status): void{
            $this->status = $status;
        }
    }

?>