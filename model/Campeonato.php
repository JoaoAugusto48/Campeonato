<?php
    
    class Campeonato{
        private $id;
        private $nome;
        private $turno;
        private $nequipe;

        //GET
        public function getId():int{
            return $this->id;
        }

        public function getNome():string{
            return $this->nome;
        }

        public function getTurno():bool{
            return $this->turno;
        }

        public function getNEquipe():int{
            return $this->nequipe;
        }

        //SET
        public function setId(int $id):void{
            $this->id = $id;
        }

        public function setNome(string $nome):void{
            $this->nome = $nome;
        }

        public function setTurno(bool $turno):void{
            $this->turno = $turno;
        }

        public function setNEquipe(int $nequipe):void{
            $this->nequipe = $nequipe;
        }
    }

?>